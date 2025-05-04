<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    // Get company profiles to access logos
    $companyProfiles = \App\Models\CompanyProfile::all()->keyBy('id');
    
    $featuredJobs = \App\Models\Job::where('status', 'active')
        ->orderBy('created_at', 'desc')
        ->take(6)
        ->get();
    
    // Get the users who posted these jobs to access their company profiles
    $jobPosters = \App\Models\User::whereIn('id', $featuredJobs->pluck('id_admin'))
        ->get()
        ->keyBy('id');
    
    return view('welcome', compact('featuredJobs', 'companyProfiles', 'jobPosters'));
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

use App\Http\Controllers\JobController;
use App\Http\Controllers\SavedJobController;

// Job search routes
Route::get('/search-jobs', [JobController::class, 'index'])->name('search.jobs');
Route::get('/jobs/autocomplete', [JobController::class, 'autocomplete'])->name('jobs.autocomplete');
Route::get('/jobs/{job_id}', [JobController::class, 'show'])->name('jobs.show')->where('job_id', '[0-9]+');

// Saved jobs routes
Route::middleware(['auth'])->group(function () {
    Route::get('/saved-jobs', [SavedJobController::class, 'index'])->name('saved-jobs.index');
    Route::post('/jobs/{job_id}/save', [SavedJobController::class, 'save'])->name('jobs.save');
    Route::delete('/jobs/{job_id}/unsave', [SavedJobController::class, 'remove'])->name('jobs.unsave');
    Route::get('/jobs/{job_id}/check-saved', [SavedJobController::class, 'checkSaved'])->name('jobs.check-saved');
    
    // Job applications routes
    Route::get('/applications', function() {
        return view('applications.index');
    })->name('applications.index');
    
    Route::get('/applications/{id}', function($id) {
        return view('applications.show', ['id' => $id]);
    })->name('applications.show');
    
    // Conversations routes
    Route::get('/conversations', function() {
        return view('conversations.index');
    })->name('conversations.index');
    
    Route::get('/conversations/create', function() {
        return view('conversations.create');
    })->name('conversations.create');
    
    Route::get('/conversations/{id}', function($id) {
        return view('conversations.show', ['id' => $id]);
    })->name('conversations.show');
});

// FAQ routes
use App\Http\Controllers\FaqController;
Route::get('/faq', [FaqController::class, 'index'])->name('faq.index');
Route::post('/faq/vote', [FaqController::class, 'recordVote'])->name('faq.vote');

// Contact routes
Route::get('/contact', function () {
    return view('contact');
})->name('contact');

// Pricing route
Route::get('/pricing', function () {
    return view('pricing');
})->name('pricing');

Route::post('/contact', function (\Illuminate\Http\Request $request) {
    // Validate the form data
    $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|email|max:255',
        'subject' => 'required|string|max:255',
        'message' => 'required|string',
    ]);
    
    // In a real application, you would process the form data here
    // For example, send an email or store in the database
    
    // Redirect back with a success message
    return redirect()->back()->with('success', 'Your message has been sent successfully. We will contact you soon!');
})->name('contact.submit');

// Application routes
use App\Http\Controllers\ApplicationController;

Route::middleware(['auth'])->group(function () {
    Route::get('/application-status', [ApplicationController::class, 'index'])->name('application.status');
    Route::post('/jobs/{id}/apply', [ApplicationController::class, 'easyApply'])->name('jobs.apply');
});

use App\Http\Controllers\CompanyProfileController;

// Company profile routes (accessible to all authenticated users)
Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/dashboard', function () {
        if (auth()->user()->role === 'admin') {
            return redirect()->route('employer.dashboard');
        }
        return view('dashboard');
    })->name('dashboard');
});

// Employer routes
// Employer Routes
Route::prefix('employer')->name('employer.')->middleware(['auth'])->group(function () {
    // Employer Dashboard
    Route::get('/dashboard', [\App\Http\Controllers\Employer\DashboardController::class, 'index'])->name('dashboard');
    
    // Employer Profile Management
    Route::get('/profile', [\App\Http\Controllers\Employer\ProfileController::class, 'edit'])->name('profile.edit');
    Route::put('/profile', [\App\Http\Controllers\Employer\ProfileController::class, 'update'])->name('profile.update');
    
    // Employer Job Management
    Route::get('/jobs', [\App\Http\Controllers\Employer\JobController::class, 'index'])->name('jobs.index');
    Route::get('/jobs/create', [\App\Http\Controllers\Employer\JobController::class, 'create'])->name('jobs.create');
    Route::post('/jobs', [\App\Http\Controllers\Employer\JobController::class, 'store'])->name('jobs.store');
    Route::get('/jobs/{id}', [\App\Http\Controllers\Employer\JobController::class, 'show'])->name('jobs.show');
    Route::get('/jobs/{id}/edit', [\App\Http\Controllers\Employer\JobController::class, 'edit'])->name('jobs.edit');
    Route::put('/jobs/{id}', [\App\Http\Controllers\Employer\JobController::class, 'update'])->name('jobs.update');
    Route::delete('/jobs/{id}', [\App\Http\Controllers\Employer\JobController::class, 'destroy'])->name('jobs.destroy');
    
    // Employer Application Management
    Route::get('/applications', [\App\Http\Controllers\Employer\ApplicationController::class, 'index'])->name('applications.index');
    Route::get('/applications/{id}', [\App\Http\Controllers\Employer\ApplicationController::class, 'show'])->name('applications.show');
    Route::put('/applications/{id}/status', [\App\Http\Controllers\Employer\ApplicationController::class, 'updateStatus'])->name('applications.update-status');
    Route::get('/applications/{id}/resume', [\App\Http\Controllers\Employer\ApplicationController::class, 'downloadResume'])->name('applications.download-resume');
    
    // Candidate Listing
    Route::get('/candidates', [\App\Http\Controllers\Employer\CandidateController::class, 'index'])->name('candidates.index');
    Route::get('/candidates/{id}', [\App\Http\Controllers\Employer\CandidateController::class, 'show'])->name('candidates.show');
    
    // Subscription Management
    Route::get('/subscription', function () {
        return view('employer.subscription');
    })->name('subscription');
    
    // Analytics Dashboard
    Route::get('/analytics', function () {
        return view('employer.analytics');
    })->name('analytics');
    
    // Job Creation (for UI demo)
    Route::get('/jobs/create-ui', function () {
        return view('employer.job-create');
    })->name('jobs.create-ui');
});

// Jobseeker Routes
Route::prefix('jobseeker')->name('jobseeker.')->middleware(['auth'])->group(function () {
    // Jobseeker Profile Management
    Route::get('/profile', [\App\Http\Controllers\Jobseeker\ProfileController::class, 'edit'])->name('profile.edit');
    Route::put('/profile', [\App\Http\Controllers\Jobseeker\ProfileController::class, 'update'])->name('profile.update');
    
    // Job Application Tracking
    Route::get('/applications', [\App\Http\Controllers\Jobseeker\ApplicationController::class, 'index'])->name('applications.index');
    Route::get('/applications/{application}', [\App\Http\Controllers\Jobseeker\ApplicationController::class, 'show'])->name('applications.show');
    Route::patch('/applications/{application}/withdraw', [\App\Http\Controllers\Jobseeker\ApplicationController::class, 'withdraw'])->name('applications.withdraw');
});

// Messaging System Routes
Route::prefix('messages')->middleware(['auth'])->group(function () {
    Route::get('/', [\App\Http\Controllers\Messages\ConversationController::class, 'index'])->name('messages.index');
    Route::get('/create', [\App\Http\Controllers\Messages\ConversationController::class, 'create'])->name('messages.create');
    Route::post('/', [\App\Http\Controllers\Messages\ConversationController::class, 'store'])->name('messages.store');
    Route::get('/{conversation}', [\App\Http\Controllers\Messages\ConversationController::class, 'show'])->name('messages.show');
    Route::post('/{conversation}/reply', [\App\Http\Controllers\Messages\ConversationController::class, 'reply'])->name('messages.reply');
});

Route::prefix('notifications')->middleware(['auth'])->group(function () {
    Route::get('/', [\App\Http\Controllers\NotificationController::class, 'index'])->name('notifications.index');
    Route::post('/{id}/read', [\App\Http\Controllers\NotificationController::class, 'markAsRead'])->name('notifications.read');
    Route::post('/read-all', [\App\Http\Controllers\NotificationController::class, 'markAllAsRead'])->name('notifications.readAll');
});

// Forum routes
Route::prefix('forum')->name('forum.')->group(function () {
    // Public routes
    Route::get('/', [App\Http\Controllers\ForumController::class, 'index'])->name('index');
    Route::get('/category/{slug}', [App\Http\Controllers\ForumController::class, 'category'])->name('category');
    Route::get('/category/{categorySlug}/thread/{threadSlug}', [App\Http\Controllers\ForumController::class, 'thread'])->name('thread');
    
    // Authenticated routes
    Route::middleware('auth')->group(function () {
        // Thread routes
        Route::get('/category/{slug}/create', [App\Http\Controllers\ForumController::class, 'createThread'])->name('create-thread');
        Route::post('/category/{slug}/store', [App\Http\Controllers\ForumController::class, 'storeThread'])->name('store-thread');
        
        // Reply routes
        Route::post('/thread/{threadId}/reply', [App\Http\Controllers\ForumReplyController::class, 'store'])->name('store-reply');
        Route::get('/reply/{id}/edit', [App\Http\Controllers\ForumReplyController::class, 'edit'])->name('edit-reply');
        Route::put('/reply/{id}', [App\Http\Controllers\ForumReplyController::class, 'update'])->name('update-reply');
        Route::delete('/reply/{id}', [App\Http\Controllers\ForumReplyController::class, 'destroy'])->name('delete-reply');
        
        // Report route
        Route::post('/report', [App\Http\Controllers\ForumController::class, 'report'])->name('report');
    });
    
    // Moderation routes (admin/moderator only)
    Route::middleware('auth')->prefix('moderation')->name('moderation.')->group(function () {
        Route::get('/reports', [App\Http\Controllers\ForumModerationController::class, 'reports'])->name('reports');
        Route::post('/reports/{id}/handle', [App\Http\Controllers\ForumModerationController::class, 'handleReport'])->name('handle-report');
        Route::post('/thread/{id}/toggle-pin', [App\Http\Controllers\ForumModerationController::class, 'togglePin'])->name('toggle-pin');
        Route::post('/thread/{id}/toggle-lock', [App\Http\Controllers\ForumModerationController::class, 'toggleLock'])->name('toggle-lock');
        Route::delete('/thread/{id}', [App\Http\Controllers\ForumModerationController::class, 'deleteThread'])->name('delete-thread');
        
        // Add specific pin/unpin and lock/unlock routes
        Route::get('/thread/{id}/pin', [App\Http\Controllers\ForumModerationController::class, 'pinThread'])->name('pin');
        Route::get('/thread/{id}/unpin', [App\Http\Controllers\ForumModerationController::class, 'unpinThread'])->name('unpin');
        Route::get('/thread/{id}/lock', [App\Http\Controllers\ForumModerationController::class, 'lockThread'])->name('lock');
        Route::get('/thread/{id}/unlock', [App\Http\Controllers\ForumModerationController::class, 'unlockThread'])->name('unlock');
    });
});

// Company Review Routes
Route::middleware('auth')->prefix('reviews')->name('reviews.')->group(function () {
    Route::get('/my', [App\Http\Controllers\ReviewController::class, 'myReviews'])->name('my');
    Route::get('/create/{employerId}', [App\Http\Controllers\ReviewController::class, 'create'])->name('create');
    Route::post('/', [App\Http\Controllers\ReviewController::class, 'store'])->name('store');
    Route::get('/{id}/edit', [App\Http\Controllers\ReviewController::class, 'edit'])->name('edit');
    Route::put('/{id}', [App\Http\Controllers\ReviewController::class, 'update'])->name('update');
    Route::get('/employer/{employerId}', [App\Http\Controllers\ReviewController::class, 'employerReviews'])->name('employer');
});

// Admin Review Moderation Routes
Route::middleware('auth')->prefix('admin/reviews')->name('admin.reviews.')->group(function () {
    Route::get('/', [App\Http\Controllers\Admin\ReviewModerationController::class, 'index'])->name('index');
    Route::get('/statistics', [App\Http\Controllers\Admin\ReviewModerationController::class, 'statistics'])->name('statistics');
    Route::get('/{id}', [App\Http\Controllers\Admin\ReviewModerationController::class, 'show'])->name('show');
    Route::post('/{id}/approve', [App\Http\Controllers\Admin\ReviewModerationController::class, 'approve'])->name('approve');
    Route::post('/{id}/reject', [App\Http\Controllers\Admin\ReviewModerationController::class, 'reject'])->name('reject');
});

// Employer Review Routes
Route::middleware('auth')->prefix('employer/reviews')->name('employer.reviews.')->group(function () {
    Route::get('/', [App\Http\Controllers\Employer\CompanyReviewController::class, 'index'])->name('index');
    Route::get('/dashboard-summary', [App\Http\Controllers\Employer\CompanyReviewController::class, 'dashboardSummary'])->name('dashboard-summary');
    Route::get('/{id}', [App\Http\Controllers\Employer\CompanyReviewController::class, 'show'])->name('show');
});

// Admin routes removed as admin role is now employer

require __DIR__.'/auth.php';
