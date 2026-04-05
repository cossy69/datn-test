<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
class TransitReference extends Model {
    protected $fillable = ['trip_id', 'provider', 'departure', 'arrival', 'estimated_price', 'fetched_at'];
    protected $casts = ['fetched_at' => 'datetime'];
    public function trip(): BelongsTo { return $this->belongsTo(Trip::class); }
}