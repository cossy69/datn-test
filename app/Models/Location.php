<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Location extends Model
{
    protected $fillable = [
        'external_place_id',
        'name',
        'lat',
        'lng',
        'category',
    ];
}