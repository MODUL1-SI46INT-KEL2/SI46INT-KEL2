<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ForumReply extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'thread_id',
        'user_id',
        'parent_id',
        'content',
    ];

    /**
     * Get the thread that owns the reply.
     */
    public function thread()
    {
        return $this->belongsTo(ForumThread::class, 'thread_id');
    }

    /**
     * Get the user that owns the reply.
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    /**
     * Get the parent reply.
     */
    public function parent()
    {
        return $this->belongsTo(ForumReply::class, 'parent_id');
    }

    /**
     * Get the child replies.
     */
    public function children()
    {
        return $this->hasMany(ForumReply::class, 'parent_id')->orderBy('created_at', 'asc');
    }

    /**
     * Get the reports for the reply.
     */
    public function reports()
    {
        return $this->morphMany(ForumReport::class, 'reportable');
    }

    /**
     * Check if the reply has children.
     */
    public function hasChildren()
    {
        return $this->children()->count() > 0;
    }
}
