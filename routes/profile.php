<?php

use App\Http\Controllers\ProfileAvatarController;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::middleware(['auth', 'verified'])->group(function () {
    $renderPrivateProfilePage = fn($requestedUserId, $view, $data = []) => $requestedUserId == auth()->user()->id
        ? Inertia::render($view, $data)
        : abort(404);

    Route::get('profiel/{id}/instellingen', fn($id) => $renderPrivateProfilePage($id, 'Profiel/ProfielInstellingen', [
        'requestedUserId' => $id,
    ]))->name('profiel.instellingen');

    Route::get('profiel/{id}/lidmaatschap', fn($id) => $renderPrivateProfilePage($id, 'Profiel/ProfielLidmaatschap', [
        'pricing' => config('stripe.prices'),
        'requestedUserId' => $id,
    ]))->name('profiel.lidmaatschap');
});

Route::middleware(['auth', 'verified'])->group(function () {
    $renderPublicProfilePage = fn($requestedUserId, $view, $data = []) => Inertia::render($view, $data);

    Route::get('profiel/{id}/overzicht', fn($id) => $renderPublicProfilePage($id, 'Profiel/ProfielOverzicht', [
        'requestedUserId' => $id,
    ]))->name('profiel.overzicht');

    Route::get('profiel/{id}/resultaten', fn($id) => $renderPublicProfilePage($id, 'Profiel/ProfielResultaten', [
        'requestedUserId' => $id,
    ]))->name('profiel.resultaten');

    Route::get('profiel/{id}/resultaten/doelen', fn($id) => $renderPublicProfilePage($id, 'Profiel/ProfielResultatenDoelen', [
        'requestedUserId' => $id,
    ]))->name('profiel.resultaten.doelen');

    Route::get('profiel/{id}/resultaten/antwoorden', fn($id) => $renderPublicProfilePage($id, 'Profiel/ProfielResultatenAntwoorden', [
        'requestedUserId' => $id,
    ]))->name('profiel.resultaten.antwoorden');

    Route::get('profiel/{id}/resultaten/statistieken', fn($id) => $renderPublicProfilePage($id, 'Profiel/ProfielResultatenStatistieken', [
        'requestedUserId' => $id,
    ]))->name('profiel.resultaten.statistieken');

    Route::get('profiel/{id}/resultaten/achievements', fn($id) => $renderPublicProfilePage($id, 'Profiel/ProfielResultatenAchievements', [
        'requestedUserId' => $id,
    ]))->name('profiel.resultaten.achievements');
});

Route::middleware(['auth', 'verified'])->group(function () {
    Route::post('/profile/avatar', [ProfileAvatarController::class, 'store'])->name('profile.avatar.store');
    Route::delete('/profile/avatar', [ProfileAvatarController::class, 'destroy'])->name('profile.avatar.destroy');
});




//    Route::patch('/profiel/instellingen', [ProfileController::class, 'update'])->name('profile.update');


