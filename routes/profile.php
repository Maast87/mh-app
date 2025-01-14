<?php

use App\Http\Controllers\ProfileAvatarController;
use App\Models\User;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Http\Controllers\CheckScoreController;
use App\Http\Controllers\AchievementController;

Route::middleware(['auth', 'verified'])->group(function () {
    $renderPrivateProfilePage = fn($tagname, $view, $data = []) =>
        ($user = User::where('tag_name', $tagname)
            ->select('id', 'name', 'tag_name', 'avatar')
            ->firstOrFail()) ?
        ($user->id == auth()->user()->id
            ? Inertia::render($view, array_merge($data, [
                'requestedTagname' => $tagname,
                'requestedUser' => $user
            ]))
            : abort(404))
        : abort(404);

        Route::get('profiel/{tagname}/instellingen', fn($tagname) => $renderPrivateProfilePage($tagname, 'Profiel/ProfielInstellingen'))
            ->name('profiel.instellingen')
            ->where('tagname', '@[a-z0-9-]+');
    
        Route::get('profiel/{tagname}/lidmaatschap', fn($tagname) => $renderPrivateProfilePage($tagname, 'Profiel/ProfielLidmaatschap', [
            'pricing' => config('stripe.prices'),
        ]))
            ->name('profiel.lidmaatschap')
            ->where('tagname', '@[a-z0-9-]+');
});

Route::middleware(['auth', 'verified'])->group(function () {
    $renderPublicProfilePage = fn($tagname, $view, $data = []) =>
        ($user = User::where('tag_name', $tagname)
            ->select('id', 'name', 'tag_name', 'avatar')
            ->firstOrFail()) ?
        Inertia::render($view, array_merge($data, [
            'requestedTagname' => $tagname,
            'requestedUser' => $user
        ])) : abort(404);


    Route::get('profiel/{tagname}/overzicht', fn($tagname) => $renderPublicProfilePage($tagname, 'Profiel/ProfielOverzicht'))
    ->name('profiel.overzicht')
    ->where('tagname', '@[a-z0-9-]+');


    Route::get('profiel/{tagname}/resultaten', [CheckScoreController::class, 'show'])
        ->name('profiel.resultaten')
        ->where('tagname', '@[a-z0-9-]+');

    Route::get('profiel/{tagname}/resultaten/doelen', fn($tagname) => $renderPublicProfilePage($tagname, 'Profiel/ProfielResultatenDoelen'))
        ->name('profiel.resultaten.doelen')
        ->where('tagname', '@[a-z0-9-]+');

    Route::get('profiel/{tagname}/resultaten/antwoorden', fn($tagname) => $renderPublicProfilePage($tagname, 'Profiel/ProfielResultatenAntwoorden'))
        ->name('profiel.resultaten.antwoorden')
        ->where('tagname', '@[a-z0-9-]+');

    Route::get('profiel/{tagname}/resultaten/statistieken', fn($tagname) => $renderPublicProfilePage($tagname, 'Profiel/ProfielResultatenStatistieken'))
        ->name('profiel.resultaten.statistieken')
        ->where('tagname', '@[a-z0-9-]+');

    Route::get('profiel/{tagname}/resultaten/achievements', [AchievementController::class, 'show'])
        ->name('profiel.resultaten.achievements')
        ->where('tagname', '@[a-z0-9-]+');
});


Route::middleware(['auth', 'verified'])->group(function () {
    Route::post('/profile/avatar', [ProfileAvatarController::class, 'store'])->name('profile.avatar.store');
    Route::delete('/profile/avatar', [ProfileAvatarController::class, 'destroy'])->name('profile.avatar.destroy');
});




//    Route::patch('/profiel/instellingen', [ProfileController::class, 'update'])->name('profile.update');


