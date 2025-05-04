<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ForumThread extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'category_id',
        'user_id',
        'title',
        'slug',
        'content',
        'is_pinned',
        'is_locked',
        'view_count',
    ];

    /**
     * Get the category that owns the thread.
     */
    public function category()
    {
        return $this->belongsTo(ForumCategory::class, 'category_id');
    }

    /**
     * Get the user that owns the thread.
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    /**
     * Get the replies for the thread.
     */
    public function replies()
    {
        return $this->hasMany(ForumReply::class, 'thread_id');
    }

    /**
     * Get the tags for the thread.
     */
    public function tags()
    {
        return $this->belongsToMany(ForumTag::class, 'forum_thread_tag', 'thread_id', 'tag_id');
    }

    /**
     * Get the reports for the thread.
     */
    public function reports()
    {
        return $this->morphMany(ForumReport::class, 'reportable');
    }

    /**
     * Get the root replies for the thread (no parent).
     */
    public function rootReplies()
    {
        return $this->replies()->whereNull('parent_id')->orderBy('created_at', 'asc');
    }

    /**
     * Get the replies count for the thread.
     */
    public function getRepliesCountAttribute()
    {
        return $this->replies()->count();
    }

    /**
     * Increment the view count.
     */
    public function incrementViewCount()
    {
        $this->increment('view_count');
        return $this;
    }
}
