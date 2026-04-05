<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ItineraryItem extends Model
{
    protected $fillable = ['trip_day_id', 'location_id', 'start_time', 'end_time', 'ai_generated_description', 'estimated_cost', 'is_locked'];
    public function tripDay(): BelongsTo { return $this->belongsTo(TripDays::class, 'trip_day_id'); }
    public function location(): BelongsTo { return $this->belongsTo(Location::class); }
    
}