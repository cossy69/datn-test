<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class PromptTemplate extends Model {
    protected $fillable = ['name', 'system_instruction', 'user_template', 'version', 'is_active'];
}