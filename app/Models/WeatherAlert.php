<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class WeatherAlert extends Model
{
    protected $fillable = ['trip_id', 'target_date', 'condition', 'min_temp', 'max_temp', 'warning_message'];
    public function trip(): BelongsTo { return $this->belongsTo(Trip::class); }
}