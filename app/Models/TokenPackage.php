<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class TokenPackage extends Model
{
    protected $fillable = ['name', 'token_amount', 'price', 'is_active'];
}