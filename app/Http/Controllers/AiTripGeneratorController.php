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
    public function generateTrip(Request $request)
    {
        // 1. Kiểm tra đầu vào
        $destination = $request->input('destination');
        if (!$destination) {
            return response()->json(['error' => 'Vui lòng nhập điểm đến'], 400);
        }

        try {
            // 2. Thiết lập Prompt chặt chẽ
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
            // Sửa lại dòng post này
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
        'details' => $response->body(), // Thêm dòng này để xem Google báo lỗi gì cụ thể
        'status' => $response->status()
    ], 500);
}

            $rawText = $response->json('candidates.0.content.parts.0.text');
            
            // 4. Làm sạch dữ liệu JSON (Quan trọng nhất)
            $cleanJson = preg_replace('/^.*?({.*}).*$/s', '$1', $rawText);
            $data = json_decode($cleanJson, true);

            if (!$data || !isset($data['days'])) {
                return response()->json(['error' => 'AI trả về dữ liệu không đúng cấu trúc', 'raw' => $rawText], 500);
            }

            // 5. Lưu vào Database dùng Transaction để đảm bảo an toàn
            $tripData = DB::transaction(function () use ($data, $destination) {
                $trip = Trip::create([
                    'user_id' => 1, // Tạm thời để 1
                    'destination_name' => $destination,
                    'start_date' => now(),
                    'end_date' => now()->addDays(2),
                    'travel_style' => 'tự do',
                ]);

                foreach ($data['days'] as $day) {
                    $tripDay = TripDays::create([
                        'trip_id' => $trip->id,
                        'day_index' => $day['day_index'],
                        'date' => now()->addDays($day['day_index'] - 1),
                    ]);

                    foreach ($day['items'] as $item) {
                        $location = Location::firstOrCreate(
                            ['name' => $item['location_name']],
                            [
                                'lat' => $item['lat'] ?? 0,
                                'lng' => $item['lng'] ?? 0
                            ]
                        );

                        ItineraryItem::create([
                            'trip_day_id' => $tripDay->id,
                            'location_id' => $location->id,
                            'start_time' => $item['start_time'],
                            'end_time' => $item['end_time'],
                        ]);
                    }
                }
                return $trip;
            });

            // 6. Trả về dữ liệu kèm quan hệ để Frontend vẽ Map
            return response()->json([
                'message' => 'Thành công',
                'data' => $tripData->load('days.items.location')
            ]);

        } catch (\Exception $e) {
            return response()->json(['error' => 'Lỗi hệ thống: ' . $e->getMessage()], 500);
        }
    }
}