<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'description',
        'logo',
        'website',
        'industry',
        'location',
    ];

    /**
     * Get the jobs for the company.
     */
    public function jobs()
    {
        return $this->hasMany(Job::class);
    }
}
