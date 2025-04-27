<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Job extends Model
{
    use HasFactory;

    /**
     * The primary key for the model.
     *
     * @var string
     */
    protected $primaryKey = 'id_job';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'id_admin',
        'title',
        'description',
        'category',
        'location',
        'salary',
        'job_type',
        'posting_date',
        'company',
        'position_type',
        'status',
    ];

    /**
     * Get the admin that posted the job.
     */
    public function admin()
    {
        return $this->belongsTo(User::class, 'id_admin');
    }

    /**
     * Get the applications for the job.
     */
    public function applications()
    {
        // Always return an empty collection since we don't need job applications
        return collect([]);
    }
    
    /**
     * Get the users who saved this job.
     */
    public function savedBy()
    {
        return $this->hasMany(SavedJob::class, 'job_id', 'id_job');
    }
}
