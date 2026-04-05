<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class TripDays extends Model
{
    protected $fillable = ['trip_id', 'day_index', 'date', 'daily_route_polyline'];

    public function trip(): BelongsTo
    {
        return $this->belongsTo(Trip::class);
    }

    public function items(): HasMany
    {
        // Quan hệ này cực quan trọng để load được địa điểm
        return $this->hasMany(ItineraryItem::class, 'trip_day_id');
    }
}