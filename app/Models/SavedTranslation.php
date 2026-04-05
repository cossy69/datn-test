<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
class SavedTranslation extends Model {
    protected $fillable = ['user_id', 'trip_id', 'original_text', 'translated_text', 'language'];
    public function user(): BelongsTo { return $this->belongsTo(User::class); }
    public function trip(): BelongsTo { return $this->belongsTo(Trip::class); }
}