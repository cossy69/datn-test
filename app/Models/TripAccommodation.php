<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
class TripAccommodation extends Model {
    protected $fillable = ['trip_id', 'location_id', 'check_in_time', 'check_out_time', 'booking_ref'];
    public function trip(): BelongsTo { return $this->belongsTo(Trip::class); }
    public function location(): BelongsTo { return $this->belongsTo(Location::class); }
}