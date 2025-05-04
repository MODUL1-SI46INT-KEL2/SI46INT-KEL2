<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'job_application_id',
        'type',
        'title',
        'message',
        'read'
    ];

    /**
     * Get the user that owns the notification.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the job application associated with the notification.
     */
    public function jobApplication()
    {
        return $this->belongsTo(JobApplication::class);
    }
}
