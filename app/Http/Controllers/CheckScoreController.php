<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\UserCheckScore;
use App\Models\User;
use App\Events\CheckCompleted;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class CheckScoreController extends Controller
{
    public function store(Request $request)
    {
        $validated = $request->validate([
            'score' => 'required|integer',
            'check_id' => 'required|integer'
        ]);

        UserCheckScore::create([
            'user_id' => Auth::id(),
            'check_id' => $validated['check_id'],
            'score' => $validated['score']
        ]);

        event(new CheckCompleted(Auth::user()));

        return redirect()->back()->with('success', 'Score opgeslagen!');
    }

    public function show(Request $request, $tagname)
    {
        $user = User::where('tag_name', $tagname)->firstOrFail();
        
        $belastbaarheidScores = UserCheckScore::where('user_id', $user->id)
            ->where('check_id', 1)
            ->orderBy('created_at', 'asc')
            ->get();

        $testScores = UserCheckScore::where('user_id', $user->id)
            ->where('check_id', 2)
            ->orderBy('created_at', 'asc')
            ->get();

        return Inertia::render('Profiel/ProfielResultaten', [
            'requestedTagname' => $tagname,
            'requestedUser' => $user,
            'belastbaarheidScores' => $belastbaarheidScores,
            'testScores' => $testScores
        ]);
    }
}

