<?php

use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\ProfileController;
use App\Http\Middleware\EnsureUserIsSubscribed;
use App\Http\Resources\CommentResource;
use App\Http\Resources\PostResource;
use App\Http\Resources\UserResource;
use App\Models\Post;
use App\Models\User;
use App\Models\Comment;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

require __DIR__.'/auth.php';

// Guest only routes
Route::middleware(['guest'])->group(function () {
    Route::get('/tot-snel', function () { return Inertia::render('Guest/TotSnel'); });
});

// Public routes (split view)
Route::get('/', function () { return Inertia::render('Public/Home'); })->name('home');

// Public routes (static)
Route::get('/contact', function () { return Inertia::render('Public/Contact'); });
Route::get('/privacybeleid', function () { return Inertia::render('Public/Privacybeleid'); });
Route::get('/voorwaarden', function () { return Inertia::render('Public/Voorwaarden'); });

// Logged in routes
Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/profiel', function () { return Inertia::render('Profiel/Profiel'); });
    Route::get('/profiel/instellingen', function () { return Inertia::render('Profiel/ProfielInstellingen'); });
    Route::patch('/profiel/instellingen', [ProfileController::class, 'update'])->name('profile.update');
    Route::get('/profiel/lidmaatschap', function () { return Inertia::render('Profiel/ProfielLidmaatschap'); });
    Route::get('/profiel/resultaten', function () { return Inertia::render('Profiel/ProfielResultaten'); });
    Route::get('/profiel/resultaten/doelen', function () { return Inertia::render('Profiel/ProfielResultatenDoelen'); });
    Route::get('/profiel/resultaten/antwoorden', function () { return Inertia::render('Profiel/ProfielResultatenAntwoorden'); });
    Route::get('/profiel/resultaten/statistieken', function () { return Inertia::render('Profiel/ProfielResultatenStatistieken'); });
    Route::get('/profiel/resultaten/achievements', function () { return Inertia::render('Profiel/ProfielResultatenAchievements'); });
    Route::get('/ondersteuning', function () { return Inertia::render('Public/Ondersteuning'); });
    Route::get('/ondersteuning/supportgroepen', function () { return Inertia::render('Public/Supportgroepen'); });
    Route::get('/ondersteuning/coaching', function () { return Inertia::render('Public/Coaching'); });
    Route::get('/ik-loop-vast', function () { return Inertia::render('Public/IkLoopVast'); });
    Route::get('/zelfcheck-ik-loop-vast', function () { return Inertia::render('Public/ZelfcheckIkLoopVast'); });
});

// Checkout routes
Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/word-lid', function () { return Inertia::render('Checkout/Subscribe'); })->middleware(['auth', 'verified'])->name('subscribe');
    Route::get('/checkout/{plan?}', CheckoutController::class)->middleware(['auth', 'verified'])->name('checkout');
    Route::get('/dankjewel', function () { return Inertia::render('Checkout/Dankjewel'); })->middleware(['auth', 'verified'])->name('success');
});

// Me-learning routes
Route::get('/me-learning', function () { return Inertia::render('Me-learning/MeLearning'); });
Route::middleware(['auth', 'verified', EnsureUserIsSubscribed::class])->group(function () {
    Route::get('/me-learning/les', function () { return Inertia::render('Me-learning/Les'); });
    Route::get('/me-learning/les1', function () { return Inertia::render('Me-learning/Les'); });
    Route::get('/me-learning/les2', function () { return Inertia::render('Me-learning/Les'); });
});

// Forum logged in routes
Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('posts/create', [PostController::class, 'create'])->name('posts.create');
    Route::post('posts', [PostController::class, 'store'])->name('posts.store');
    Route::post('posts/{post}/comments', [CommentController::class, 'store'])->name('posts.comments.store');
    Route::delete('comments/{comment}', [CommentController::class, 'destroy'])->name('comments.destroy');
    Route::put('comments/{comment}', [CommentController::class, 'update'])->name('comments.update');
});

// Forum public routes
Route::get('/posts', [PostController::class, 'index'])->name('posts.index');
Route::get('/posts/{post}/{slug}', [PostController::class, 'show'])
    ->where('slug', '.*')
    ->name('posts.show');

