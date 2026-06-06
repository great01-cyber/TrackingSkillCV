<?php

// app/Http/Controllers/Auth/RegisteredUserController.php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\View\View;
use Illuminate\Validation\Rules\Password;

class RegisteredUserController extends Controller
{
    /**
     * Show the sign-up form.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle a sign-up request.
     */
    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            // Account
            'name'               => ['required', 'string', 'max:255'], // Full name
            'email'              => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:users,email'],
            'password'           => ['required', 'confirmed', Password::defaults()],

            // CV header
            'professional_title' => ['nullable', 'string', 'max:255'],
            'phone'              => ['nullable', 'string', 'max:30'],
            'university'         => ['nullable', 'string', 'max:255'],
            'course'             => ['nullable', 'string', 'max:255'],
            'city'               => ['nullable', 'string', 'max:120'],
            'country'            => ['nullable', 'string', 'max:120'],
            'linkedin_url'       => ['nullable', 'url', 'max:255'],
            'github_url'         => ['nullable', 'url', 'max:255'],
            'portfolio_url'      => ['nullable', 'url', 'max:255'],
        ]);

        $validated['password'] = Hash::make($validated['password']);

        $user = User::create($validated);

        event(new Registered($user));

        Auth::login($user);

        // Change 'dashboard' to whatever your post-login route is named.
        return redirect()
            ->route('dashboard')
            ->with('status', 'Welcome to SkillFokio, ' . $user->name . '!');
    }
}
