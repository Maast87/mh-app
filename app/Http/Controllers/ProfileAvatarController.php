<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProfileAvatarController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'avatar' => ['required', 'image', 'max:1024'], // 1MB Max
        ]);

        try {
            $avatarsPath = Storage::disk('public')->path('avatars');
            if (!file_exists($avatarsPath)) {
                Storage::disk('public')->makeDirectory('avatars');
            }

            // Store the new avatar
            $path = $request->file('avatar')->store('avatars', 'public');
            
            // Delete old avatar if it exists
            $this->deleteOldAvatar($request->user());
            
            // Update user with new avatar URL
            $request->user()->update([
                'avatar' => Storage::disk('public')->url($path)
            ]);

        } catch (\Exception $e) {
            return back()->withErrors(['avatar' => 'Failed to upload avatar: ' . $e->getMessage()]);
        }
    }

    /**
     * Delete the user's old avatar file if it exists
     */
    private function deleteOldAvatar($user): void
    {
        if (!$user->avatar) {
            return;
        }

        // Extract the file path from the URL
        $oldPath = str_replace('/storage/', '', parse_url($user->avatar, PHP_URL_PATH));
        
        if ($oldPath && Storage::disk('public')->exists($oldPath)) {
            Storage::disk('public')->delete($oldPath);
        }
    }
}
