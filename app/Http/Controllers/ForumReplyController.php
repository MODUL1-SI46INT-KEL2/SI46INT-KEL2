<?php

namespace App\Http\Controllers;

use App\Models\ForumThread;
use App\Models\ForumReply;
use Illuminate\Http\Request;

class ForumReplyController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // No middleware here - we'll handle auth in the routes
    }

    /**
     * Store a newly created reply in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $threadId
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $threadId)
    {
        $thread = ForumThread::findOrFail($threadId);
        
        // Check if thread is locked
        if ($thread->is_locked) {
            return back()->with('error', 'This thread is locked and cannot receive new replies.');
        }
        
        $validated = $request->validate([
            'content' => 'required|min:2',
            'parent_id' => 'nullable|exists:forum_replies,id',
        ]);
        
        $reply = new ForumReply();
        $reply->thread_id = $thread->id;
        $reply->user_id = auth()->id();
        $reply->parent_id = $validated['parent_id'] ?? null;
        $reply->content = $validated['content'];
        $reply->save();
        
        return back()->with('success', 'Reply posted successfully!');
    }

    /**
     * Show the form for editing the specified reply.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $reply = ForumReply::findOrFail($id);
        
        // Authorization check
        if (auth()->id() !== $reply->user_id && !auth()->user()->hasRole('moderator')) {
            return back()->with('error', 'You are not authorized to edit this reply.');
        }
        
        return view('forum.edit_reply', compact('reply'));
    }

    /**
     * Update the specified reply in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $reply = ForumReply::findOrFail($id);
        
        // Authorization check
        if (auth()->id() !== $reply->user_id && !auth()->user()->hasRole('moderator')) {
            return back()->with('error', 'You are not authorized to edit this reply.');
        }
        
        $validated = $request->validate([
            'content' => 'required|min:2',
        ]);
        
        $reply->content = $validated['content'];
        $reply->save();
        
        return redirect()->route('forum.thread', [
            'categorySlug' => $reply->thread->category->slug,
            'threadSlug' => $reply->thread->slug
        ])->with('success', 'Reply updated successfully!');
    }

    /**
     * Remove the specified reply from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $reply = ForumReply::findOrFail($id);
        
        // Authorization check
        if (auth()->id() !== $reply->user_id && !auth()->user()->hasRole('moderator')) {
            return back()->with('error', 'You are not authorized to delete this reply.');
        }
        
        // If the reply has children, soft delete it
        // Otherwise, permanently delete it
        if ($reply->hasChildren()) {
            $reply->delete(); // Soft delete
        } else {
            $reply->forceDelete(); // Permanent delete
        }
        
        return back()->with('success', 'Reply deleted successfully!');
    }
}
