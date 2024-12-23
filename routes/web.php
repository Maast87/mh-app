<?php

use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\ProfileController;
use App\Http\Middleware\EnsureUserIsSubscribed;
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

Route::get('/ik-loop-vast', function () {
    return Inertia::render('IkLoopVast');
});

Route::get('/profiel', function () {
    return Inertia::render('Profiel');
});

Route::get('/profiel/resultaten', function () {
    return Inertia::render('ProfielResultaten');
});

Route::get('/profiel/instellingen', function () {
    return Inertia::render('ProfielInstellingen');
});

Route::get('/profiel/lidmaatschap', function () {
    return Inertia::render('ProfielLidmaatschap');
});

Route::get('/word-lid', function () {
    return Inertia::render('Subscribe');
})
    ->middleware(['auth', 'verified'])
    ->name('subscribe');


Route::get('/checkout/{plan?}', CheckoutController::class)
    ->middleware(['auth', 'verified'])
    ->name('checkout');

Route::get('/dankjewel', function () {
    return Inertia::render('Dankjewel');
})
    ->middleware(['auth', 'verified'])
    ->name('success');

Route::get('/me-learning', function () {
    return Inertia::render('MeLearning');
})
    ->middleware(['auth', 'verified', EnsureUserIsSubscribed::class]);


require __DIR__.'/auth.php';
