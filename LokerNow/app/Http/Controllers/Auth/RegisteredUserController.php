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
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        // Validate input
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:users,email'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'role' => ['required', 'in:job_seeker,employer'],  // Ensure role is selected
        ]);

        // Check if email already exists with a different role
        $existingUser = User::where('email', $request->email)->first();
        if ($existingUser && $existingUser->role !== $request->role) {
            return redirect()->back()->withErrors(['email' => 'This email is already registered with a different role.']);
        }

        // Create new user with the selected role
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => $request->role,  // Assign the role
        ]);

        // Trigger Registered event and log the user in
        event(new Registered($user));
        Auth::login($user);

        // Redirect to dashboard
        return redirect(route('dashboard', absolute: false));
    }
}

