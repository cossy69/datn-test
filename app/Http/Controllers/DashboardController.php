<?php

namespace App\Http\Controllers;

use App\Models\Trip;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        // Lấy 3 chuyến đi gần nhất của chính Toby để hiện ra card cho đẹp
        $itineraries = Trip::where('user_id', auth()->id())
            ->latest()
            ->take(3)
            ->get();

        return view('dashboard', compact('itineraries'));
    }
    public function show(\App\Models\Trip $trip)
    {
        // Bảo mật: Chỉ cho phép Toby xem lịch trình của chính mình
        if ($trip->user_id !== auth()->id()) {
            abort(403);
        }

        // Load đầy đủ các ngày và địa điểm bên trong
        $trip->load('days.items.location');

        return view('trips.show', compact('trip'));
    }
}
