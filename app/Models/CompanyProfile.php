<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CompanyProfile extends Model
{
    use HasFactory;

    // Define the fillable attributes
    protected $fillable = [
        'name',          // Company name
        'website',       // Company website URL
        'logo_path',     // To store the path of the company logo
        'banner_path',   // To store the path of the company banner
        'tagline',       // To store the company's tagline
        'user_id',       // Associated user ID
    ];

    // Optional: If you're storing the timestamps
    public $timestamps = true;

    /**
     * Get the user that owns the company profile.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}

