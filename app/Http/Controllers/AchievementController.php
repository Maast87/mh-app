<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Services\AchievementService;
use Illuminate\Http\Request;
use Inertia\Inertia;

class AchievementController extends Controller
{
    public function __construct(
        private AchievementService $achievementService
    ) {}

    /**
     * Display user's achievements in their profile.
     */
    public function show(Request $request, string $tagname)
    {
        $user = User::where('tag_name', $tagname)->firstOrFail();
        
        return Inertia::render('Profiel/ProfielResultatenAchievements', [
            'achievementTypes' => $this->achievementService->getUserAchievements($user),
            'requestedTagname' => $tagname,
            'requestedUser' => [
                'id' => $user->id,
                'name' => $user->name,
                'tag_name' => $user->tag_name,
                'avatar' => $user->avatar,
            ],
        ]);
    }

    /**
     * Award an achievement to the authenticated user.
     */
    public function award(Request $request)
    {
        $result = $this->achievementService->tryAwardAchievement(
            $request->user(),
            $request->achievement_id
        );

        return back()->with($result['success'] ? 'success' : 'error', $result['message']);
    }
} 