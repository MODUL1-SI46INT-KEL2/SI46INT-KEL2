<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JobseekerProfile extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'user_id',
        'resume_path',
        'portfolio_path',
        'portfolio_description',
        'skills',
        'experience',
        'education',
        'job_title',
        'location',
        'website',
        'linkedin',
        'github',
        'bio',
        'available_for_hire',
    ];

    /**
     * Get the user that owns the profile.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
