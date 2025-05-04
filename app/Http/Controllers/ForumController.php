<?php

namespace App\Http\Controllers;

use App\Models\ForumCategory;
use App\Models\ForumThread;
use App\Models\ForumReply;
use App\Models\ForumTag;
use App\Models\ForumReport;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ForumController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // No middleware here - we'll handle it in routes
    }

    /**
     * Display the forum index with all categories.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = ForumCategory::orderBy('order')->get();
        
        return view('forum.index', compact('categories'));
    }

    /**
     * Display the specified category with its threads.
     *
     * @param  string  $slug
     * @return \Illuminate\Http\Response
     */
    public function category($slug)
    {
        $category = ForumCategory::where('slug', $slug)->firstOrFail();
        $threads = $category->threads()
            ->with(['user', 'tags'])
            ->withCount('replies')
            ->orderBy('is_pinned', 'desc')
            ->orderBy('created_at', 'desc')
            ->paginate(15);
        
        return view('forum.category', compact('category', 'threads'));
    }

    /**
     * Show the form for creating a new thread.
     *
     * @param  string  $categorySlug
     * @return \Illuminate\Http\Response
     */
    public function createThread($categorySlug)
    {
        $category = ForumCategory::where('slug', $categorySlug)->firstOrFail();
        $tags = ForumTag::orderBy('name')->get();
        
        return view('forum.create-thread', compact('category', 'tags'));
    }

    /**
     * Store a newly created thread in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  string  $categorySlug
     * @return \Illuminate\Http\Response
     */
    public function storeThread(Request $request, $categorySlug)
    {
        $category = ForumCategory::where('slug', $categorySlug)->firstOrFail();
        
        $validated = $request->validate([
            'title' => 'required|min:5|max:255',
            'content' => 'required|min:10',
            'tags' => 'nullable|array',
            'tags.*' => 'exists:forum_tags,id',
        ]);
        
        $thread = new ForumThread();
        $thread->category_id = $category->id;
        $thread->user_id = auth()->id();
        $thread->title = $validated['title'];
        $thread->slug = Str::slug($validated['title']) . '-' . Str::random(6);
        $thread->content = $validated['content'];
        $thread->save();
        
        if (isset($validated['tags'])) {
            $thread->tags()->attach($validated['tags']);
        }
        
        return redirect()->route('forum.thread', ['categorySlug' => $category->slug, 'threadSlug' => $thread->slug])
            ->with('success', 'Thread created successfully!');
    }

    /**
     * Display the specified thread.
     *
     * @param  string  $categorySlug
     * @param  string  $threadSlug
     * @return \Illuminate\Http\Response
     */
    public function thread($categorySlug, $threadSlug)
    {
        $category = ForumCategory::where('slug', $categorySlug)->firstOrFail();
        $thread = ForumThread::where('slug', $threadSlug)
            ->where('category_id', $category->id)
            ->with(['user', 'tags'])
            ->firstOrFail();
        
        // Increment view count
        $thread->incrementViewCount();
        
        $replies = $thread->rootReplies()
            ->with(['user', 'children.user'])
            ->paginate(15);
        
        return view('forum.thread', compact('category', 'thread', 'replies'));
    }

    /**
     * Report a thread or reply.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function report(Request $request)
    {
        $validated = $request->validate([
            'reportable_type' => 'required|in:thread,reply',
            'reportable_id' => 'required|integer',
            'reason' => 'required|string|max:255',
            'description' => 'nullable|string|max:1000',
        ]);
        
        // Map the reportable type to the correct model class
        if ($validated['reportable_type'] === 'thread') {
            $reportable = ForumThread::findOrFail($validated['reportable_id']);
        } else { // reply
            $reportable = ForumReply::findOrFail($validated['reportable_id']);
        }
        
        // Create the report
        $report = $reportable->reports()->create([
            'user_id' => auth()->id(),
            'reason' => $validated['reason'],
            'description' => $validated['description'],
            'status' => 'pending',
        ]);
        
        return back()->with('success', 'Report submitted successfully. A moderator will review it shortly.');
    }
}
