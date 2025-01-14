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
use Inertia\Inertia;
use Inertia\Response;
use Illuminate\Support\Facades\Log;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): Response
    {
        return Inertia::render('Auth/Register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        Log::info('Starting user registration process', [
            'email' => $request->email
        ]);

        $request->validate([
            'name' => 'required|string|max:255|unique:users,name',
            'tag_name' => 'required|string|max:255|lowercase|unique:users,tag_name',
            'email' => 'required|string|lowercase|email|max:255|unique:'.User::class,
            'password' => ['required', 'confirmed', Rules\Password::defaults()->min(10)->mixedCase()->numbers()],
        ]);

        $name = $this->sanitizeName($request->name);
        $tagName = $this->generateTagNameFromName($name);

        Log::info('Creating new user', [
            'name' => $name,
            'tag_name' => $tagName,
            'email' => $request->email
        ]);

        $user = User::create([
            'name' => $name,
            'tag_name' => $tagName,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        Log::info('User created successfully', [
            'user_id' => $user->id,
            'email' => $user->email
        ]);

        event(new Registered($user));
        Log::info('Registered event dispatched');

        Auth::login($user);
        Log::info('User logged in successfully');

        return redirect()->route('verification.notice');
    }

    /**
     * Sanitize the 'name' field using specific string conversions.
     *
     * @param  string  $name
     * @return string
     */
    private function sanitizeName(string $name): string
    {
        // Replace multiple spaces with a single space
        $name = preg_replace('/\s+/u', ' ', $name);

        // Remove any characters that are not a-z, A-Z, 0-9, or spaces
        $name = preg_replace('/[^a-zA-Z0-9\s]/u', '', $name);

        // Trim leading and trailing spaces
        $name = trim($name);

        return $name;
    }

    /**
     * Generate a tag_name from the sanitized name using specific string conversions.
     *
     * @param  string  $name
     * @return string
     */
    private function generateTagNameFromName(string $name): string
    {
        // Convert to lowercase
        $name = strtolower($name);

        // Replace spaces with hyphens
        $name = preg_replace('/\s+/u', '-', $name);

        // Remove any characters that are not a-z, 0-9, or hyphens
        $name = preg_replace('/[^a-z0-9-]/u', '', $name);

        // Consolidate multiple hyphens into a single hyphen
        $name = preg_replace('/-+/u', '-', $name);

        // Trim leading/trailing hyphens
        $name = trim($name, '-');

        // Return the tag_name with an '@' symbol at the beginning
        return '@' . $name;
    }
}
