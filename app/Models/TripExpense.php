<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class TripExpense extends Model
{
    protected $fillable = ['trip_id', 'itinerary_item_id', 'category', 'planned_amount', 'actual_amount'];
    public function trip(): BelongsTo { return $this->belongsTo(Trip::class); }
}