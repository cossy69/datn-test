<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\Models\Trip;
use App\Models\TripDays;
use App\Models\ItineraryItem;
use App\Models\Location;
use Illuminate\Support\Facades\DB;

class AiTripGeneratorController extends Controller
{
    /**
     * Hàm chính xử lý tạo lịch trình bằng AI
     */
    public function generateTrip(Request $request)
    {
        // 1. Kiểm tra đầu vào
        $destination = $request->input('destination');
        if (!$destination) {
            return response()->json(['error' => 'Vui lòng nhập điểm đến đã ông ơi!'], 400);
        }

        // Kiểm tra xem Toby đã đăng nhập chưa
        $userId = auth()->id();
        if (!$userId) {
            return response()->json(['error' => 'Cậu cần đăng nhập để lưu lịch trình nhé!'], 401);
        }

        try {
            // 2. Thiết lập Prompt (Lucy đã tối ưu để Gemini không trả về rác)
            $prompt = "Bạn là chuyên gia du lịch. Hãy lên lịch trình đi {$destination} trong 3 ngày. 
            Chỉ trả về duy nhất một chuỗi JSON chuẩn (không kèm markdown, không giải thích), cấu trúc chính xác như sau:
            {
              \"days\": [
                {
                  \"day_index\": 1,
                  \"items\": [
                    {
                      \"location_name\": \"Tên địa điểm cụ thể\",
                      \"lat\": 16.0611,
                      \"lng\": 108.2273,
                      \"start_time\": \"08:00\",
                      \"end_time\": \"10:00\"
                    }
                  ]
                }
              ]
            }";

            // 3. Gọi API Gemini
            $apiKey = env('GEMINI_API_KEY');
            $response = Http::withoutVerifying()
                ->post("https://generativelanguage.googleapis.com/v1beta/models/gemini-2.5-flash:generateContent?key={$apiKey}", [
                    'contents' => [
                        [
                            'parts' => [
                                ['text' => $prompt]
                            ]
                        ]
                    ]
                ]);

            if ($response->failed()) {
                return response()->json([
                    'error' => 'Lỗi kết nối API Gemini',
                    'details' => $response->body()
                ], 500);
            }

            $rawText = $response->json('candidates.0.content.parts.0.text');

            // 4. Làm sạch dữ liệu JSON
            $cleanJson = preg_replace('/^.*?({.*}).*$/s', '$1', $rawText);
            $data = json_decode($cleanJson, true);

            if (!$data || !isset($data['days'])) {
                return response()->json(['error' => 'AI trả về dữ liệu không đúng cấu trúc', 'raw' => $rawText], 500);
            }

            // 5. Lưu vào Database dùng Transaction để đảm bảo tính toàn vẹn
            $trip = DB::transaction(function () use ($data, $destination, $userId) {
                // Tạo chuyến đi chính gắn với ID của Toby
                $newTrip = Trip::create([
                    'user_id' => $userId,
                    'destination_name' => $destination,
                    'start_date' => now(),
                    'end_date' => now()->addDays(2),
                    'travel_style' => 'tự do',
                    'status' => 'planned'
                ]);

                foreach ($data['days'] as $day) {
                    // Tạo từng ngày trong chuyến đi
                    $tripDay = TripDays::create([
                        'trip_id' => $newTrip->id,
                        'day_index' => $day['day_index'],
                        'date' => now()->addDays($day['day_index'] - 1),
                    ]);

                    foreach ($day['items'] as $item) {
                        // Lưu địa điểm (nếu trùng tên thì lấy cái cũ, không thì tạo mới)
                        $location = Location::firstOrCreate(
                            ['name' => $item['location_name']],
                            [
                                'lat' => $item['lat'] ?? 0,
                                'lng' => $item['lng'] ?? 0
                            ]
                        );

                        // Lưu chi tiết hoạt động
                        ItineraryItem::create([
                            'trip_day_id' => $tripDay->id,
                            'location_id' => $location->id,
                            'start_time' => $item['start_time'],
                            'end_time' => $item['end_time'],
                        ]);
                    }
                }
                return $newTrip;
            });

            // 6. Trả về dữ liệu kèm theo các quan hệ (để Frontend vẽ Map và List)
            return response()->json([
                'message' => 'Lên lịch trình thành công rồi nè Toby!',
                'data' => $trip->load(['days.items.location'])
            ]);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Lỗi hệ thống rồi: ' . $e->getMessage()], 500);
        }
    }
}
