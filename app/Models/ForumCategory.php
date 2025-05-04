<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ForumCategory extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
        'description',
        'order',
    ];

    /**
     * Get the threads for the category.
     */
    public function threads()
    {
        return $this->hasMany(ForumThread::class, 'category_id');
    }

    /**
     * Get the threads count for the category.
     */
    public function getThreadsCountAttribute()
    {
        return $this->threads()->count();
    }

    /**
     * Get the replies count for the category.
     */
    public function getRepliesCountAttribute()
    {
        return ForumReply::whereHas('thread', function ($query) {
            $query->where('category_id', $this->id);
        })->count();
    }

    /**
     * Get the latest thread for the category.
     */
    public function getLatestThreadAttribute()
    {
        return $this->threads()->latest()->first();
    }
}
