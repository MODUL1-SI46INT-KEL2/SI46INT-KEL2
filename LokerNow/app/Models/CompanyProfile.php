<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CompanyProfile extends Model
{
    use HasFactory;

    // Define the table (optional if the table name follows Laravel's convention)
    protected $table = 'company_profiles';

    // The attributes that are mass assignable
    protected $fillable = [
        'user_id', // Foreign key to the users table
        'company_name',
        'company_description',
        // Add other fields as needed
    ];

    // Define the relationship with the User model
    public function user()
    {
        return $this->belongsTo(User::class); // CompanyProfile belongs to a User
    }
}
