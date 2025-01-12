<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Inertia\Inertia;

class UsernameValidationController extends Controller
{
    public function checkUsername(Request $request)
    {
        $name = $request->input('name');
        
        // Case-insensitive check for both name and tag_name
        $exists = User::where(function($query) use ($name) {
            $query->whereRaw('LOWER(name) = ?', [strtolower($name)])
                  ->orWhereRaw('LOWER(tag_name) = ?', ['@' . strtolower(
                      preg_replace('/-+/', '-',
                          preg_replace('/[^a-z0-9-]/', '',
                              str_replace(' ', '-', strtolower($name))
                          )
                      )
                  )]);
        })->exists();
        
        if ($request->wantsJson()) {
            return response()->json(['exists' => $exists]);
        }
        
        return Inertia::render('Auth/Register', [
            'exists' => $exists
        ]);
    }
} 