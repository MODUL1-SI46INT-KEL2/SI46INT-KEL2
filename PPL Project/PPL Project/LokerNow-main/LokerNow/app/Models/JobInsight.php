<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class JobInsight extends Model
{
    protected $fillable = ['title', 'content', 'image', 'comparison_data'];

    protected $casts = [
        'comparison_data' => 'array',
    ];
}

