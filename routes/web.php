<?php

use Illuminate\Support\Facades\Route;
use Livewire\Volt\Volt;

use App\Http\Controllers\DashboardController;

// Thay thế dòng cũ bằng dòng này
Route::get('/', [DashboardController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard');


Route::middleware(['auth'])->group(function () {
    Route::redirect('settings', 'settings/profile');

    Volt::route('settings/profile', 'settings.profile')->name('settings.profile');
    Volt::route('settings/password', 'settings.password')->name('settings.password');
    Volt::route('settings/appearance', 'settings.appearance')->name('settings.appearance');
});

require __DIR__ . '/auth.php';
// Tìm cái dòng Route::get('/test-ui', ...) cũ của cậu
// Và bọc nó lại như thế này:

Route::middleware(['auth'])->group(function () {
    Route::get('/test-ui', function () {
        return view('test-ai');
    });
    Route::post('/generate-trip', [App\Http\Controllers\AiTripGeneratorController::class, 'generateTrip']);
    Route::get('/trips/{trip}', [App\Http\Controllers\DashboardController::class, 'show'])->name('trips.show');

    // Nếu cậu có thêm Route POST để xử lý generateTrip thì cũng cho vào đây luôn

});
