<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::get('/home', function () {
    return Inertia::render('Home', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
    ]);
});

Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::get('/mijn-doelen', function () {
    return Inertia::render('MijnDoelen');
});

Route::get('/mijn-antwoorden', function () {
    return Inertia::render('MijnAntwoorden');
});

Route::get('/mijn-statistieken', function () {
    return Inertia::render('MijnStatistieken');
});

Route::get('/mijn-achievements', function () {
    return Inertia::render('MijnAchievements');
});

Route::get('/al-mijn-resultaten', function () {
    return Inertia::render('AlMijnResultaten');
});

Route::get('/mijn-supportgroepen', function () {
    return Inertia::render('MijnSupportgroepen');
});

Route::get('/coaching', function () {
    return Inertia::render('Coaching');
});

Route::get('/veelgestelde-vragen', function () {
    return Inertia::render('VeelgesteldeVragen');
});

Route::get('/me-learning', function () {
    return Inertia::render('MeLearning');
});

Route::get('/ik-loop-vast', function () {
    return Inertia::render('IkLoopVast');
});

Route::get('/mijn-profiel', function () {
    return Inertia::render('MijnProfiel');
});

Route::get('/instellingen', function () {
    return Inertia::render('Instellingen');
});

Route::get('/lidmaatschap', function () {
    return Inertia::render('Lidmaatschap');
});


require __DIR__.'/auth.php';
