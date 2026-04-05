<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Trip extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'destination_name',
        'start_date',
        'end_date',
        'travel_style',
        'total_budget_limit',
        'status',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
    public function days()
{
    return $this->hasMany(TripDays::class, 'trip_id');
}
}