<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class CompanyReview extends Model
{
    use HasFactory;
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'user_id',
        'admin_id',
        'rating',
        'content',
        'job_title',
        'employment_period',
        'status',
        'rejection_reason',
        'moderated_at',
        'moderated_by',
        'anonymous'
    ];
    
    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'moderated_at' => 'datetime',
        'anonymous' => 'boolean',
    ];
    
    /**
     * Get the jobseeker who authored the review.
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
    
    /**
     * Get the employer being reviewed.
     */
    public function employer()
    {
        return $this->belongsTo(User::class, 'admin_id');
    }
    
    /**
     * Get the admin who moderated the review.
     */
    public function moderator()
    {
        return $this->belongsTo(User::class, 'moderated_by');
    }
    
    /**
     * Scope a query to only include pending reviews.
     */
    public function scopePending($query)
    {
        return $query->where('status', 'pending');
    }
    
    /**
     * Scope a query to only include approved reviews.
     */
    public function scopeApproved($query)
    {
        return $query->where('status', 'approved');
    }
    
    /**
     * Scope a query to only include rejected reviews.
     */
    public function scopeRejected($query)
    {
        return $query->where('status', 'rejected');
    }
}
