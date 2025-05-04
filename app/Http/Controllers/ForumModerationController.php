<?php

namespace App\Http\Controllers;

use App\Models\ForumReport;
use App\Models\ForumThread;
use App\Models\ForumReply;
use Illuminate\Http\Request;

class ForumModerationController extends Controller
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
     * Check if the user has moderator permissions.
     *
     * @return \Illuminate\Http\Response|null
     */
    private function checkModeratorPermissions()
    {
        if (!auth()->check() || !in_array(auth()->user()->role, ['admin', 'moderator'])) {
            abort(403, 'You do not have permission to access this page.');
        }
        
        return null;
    }

    /**
     * Display a listing of reports.
     *
     * @return \Illuminate\Http\Response
     */
    public function reports()
    {
        $this->checkModeratorPermissions();
        
        $pendingReports = ForumReport::with(['user', 'reportable'])
            ->where('status', 'pending')
            ->orderBy('created_at', 'desc')
            ->paginate(15);
            
        $resolvedReports = ForumReport::with(['user', 'reportable', 'reviewer'])
            ->whereIn('status', ['reviewed', 'resolved', 'dismissed'])
            ->orderBy('reviewed_at', 'desc')
            ->paginate(15);
        
        return view('forum.moderation.reports', compact('pendingReports', 'resolvedReports'));
    }

    /**
     * Handle a report.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function handleReport(Request $request, $id)
    {
        $this->checkModeratorPermissions();
        
        $report = ForumReport::findOrFail($id);
        
        $validated = $request->validate([
            'action' => 'required|in:dismiss,hide,delete',
            'admin_notes' => 'nullable|string|max:1000',
        ]);
        
        $reportable = $report->reportable;
        
        // Handle the report based on the action
        switch ($validated['action']) {
            case 'dismiss':
                $report->status = 'dismissed';
                break;
                
            case 'hide':
                $report->status = 'resolved';
                
                // Soft delete the reportable item
                $reportable->delete();
                break;
                
            case 'delete':
                $report->status = 'resolved';
                
                // Permanently delete the reportable item
                $reportable->forceDelete();
                break;
        }
        
        // Update the report
        $report->admin_notes = $validated['admin_notes'];
        $report->reviewed_by = auth()->id();
        $report->reviewed_at = now();
        $report->save();
        
        return back()->with('success', 'Report handled successfully.');
    }

    /**
     * Pin or unpin a thread.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function togglePin($id)
    {
        $this->checkModeratorPermissions();
        
        $thread = ForumThread::findOrFail($id);
        $thread->is_pinned = !$thread->is_pinned;
        $thread->save();
        
        $status = $thread->is_pinned ? 'pinned' : 'unpinned';
        
        return back()->with('success', "Thread {$status} successfully.");
    }

    /**
     * Lock or unlock a thread.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function toggleLock($id)
    {
        $this->checkModeratorPermissions();
        
        $thread = ForumThread::findOrFail($id);
        $thread->is_locked = !$thread->is_locked;
        $thread->save();
        
        $status = $thread->is_locked ? 'locked' : 'unlocked';
        
        return back()->with('success', "Thread {$status} successfully.");
    }

    /**
     * Delete a thread.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function deleteThread($id)
    {
        $this->checkModeratorPermissions();
        
        $thread = ForumThread::findOrFail($id);
        $categorySlug = $thread->category->slug;
        
        // Delete the thread (soft delete)
        $thread->delete();
        
        return redirect()->route('forum.category', $categorySlug)
            ->with('success', 'Thread deleted successfully.');
    }
    
    /**
     * Pin a thread.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function pinThread($id)
    {
        $this->checkModeratorPermissions();
        
        $thread = ForumThread::findOrFail($id);
        $thread->is_pinned = true;
        $thread->save();
        
        return back()->with('success', 'Thread pinned successfully.');
    }
    
    /**
     * Unpin a thread.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function unpinThread($id)
    {
        $this->checkModeratorPermissions();
        
        $thread = ForumThread::findOrFail($id);
        $thread->is_pinned = false;
        $thread->save();
        
        return back()->with('success', 'Thread unpinned successfully.');
    }
    
    /**
     * Lock a thread.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function lockThread($id)
    {
        $this->checkModeratorPermissions();
        
        $thread = ForumThread::findOrFail($id);
        $thread->is_locked = true;
        $thread->save();
        
        return back()->with('success', 'Thread locked successfully.');
    }
    
    /**
     * Unlock a thread.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function unlockThread($id)
    {
        $this->checkModeratorPermissions();
        
        $thread = ForumThread::findOrFail($id);
        $thread->is_locked = false;
        $thread->save();
        
        return back()->with('success', 'Thread unlocked successfully.');
    }
}
