<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ForumTag extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
        'color',
    ];

    /**
     * Get the threads for the tag.
     */
    public function threads()
    {
        return $this->belongsToMany(ForumThread::class, 'forum_thread_tag', 'tag_id', 'thread_id');
    }
}
