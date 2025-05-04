<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register-jobseeker');
    }

    /**
     * Display the registration type selection view.
     * Now redirects directly to job seeker registration
     */
    public function showRegistrationSelection(): View
    {
        return view('auth.register-jobseeker');
    }

    /**
     * Display the job seeker registration view.
     */
    public function showJobSeekerRegistration(): View
    {
        return view('auth.register-jobseeker');
    }

    // Admin registration method removed for security

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        // Force role to be jobseeker for security
        $request->merge(['role' => 'jobseeker']);
        
        // Validation rules
        $rules = [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'phone' => ['required', 'string', 'max:20'],
        ];
        
        $request->validate($rules);

        // Create the user
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'jobseeker',
            'phone' => $request->phone,
        ]);

        event(new Registered($user));

        Auth::login($user);

        // Redirect based on user role
        if ($user->role === 'admin') {
            // Admin role sees the admin dashboard
            return redirect('/admin/dashboard');
        } else {
            // Default for job seekers
            return redirect('/saved-jobs');
        }
    }
}
