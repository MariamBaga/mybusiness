<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

// Web Controllers
use App\Http\Controllers\Web\PageController;
use App\Http\Controllers\Web\HomeController;
use App\Http\Controllers\Web\BlogController;
use App\Http\Controllers\Web\SupportController;

// Admin Controllers
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\PostController;
use App\Http\Controllers\Admin\AdvertisementController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\PartnerController;
use App\Http\Controllers\Admin\DocumentController;
use App\Http\Controllers\Admin\FaqController;
use App\Http\Controllers\Admin\NotificationsController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\SponsorController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\TagController;
use App\Http\Controllers\Admin\TicketController;
use App\Http\Controllers\Admin\SettingController;

/*
|--------------------------------------------------------------------------
| PUBLIC ROUTES
|--------------------------------------------------------------------------
*/

Route::get('/', [HomeController::class, 'index'])->name('home');

// Pages statiques
Route::prefix('pages')->group(function () {
    Route::get('/about', [PageController::class, 'about'])->name('pages.about');
    Route::get('/features', [PageController::class, 'features'])->name('pages.features');
    Route::get('/pricing', [PageController::class, 'pricing'])->name('pages.pricing');
    Route::get('/downloads', [PageController::class, 'downloads'])->name('pages.downloads');
    Route::get('/partners', [PageController::class, 'partners'])->name('pages.partners');
    Route::get('/legal', [PageController::class, 'legal'])->name('pages.legal');
    Route::get('/privacy', [PageController::class, 'privacy'])->name('pages.privacy');
});

// Blog public
Route::prefix('blog')->name('blog.')->group(function () {
    Route::get('/', [BlogController::class, 'index'])->name('index');
    Route::get('/{slug}', [BlogController::class, 'show'])->name('show');
});

// Support public
Route::prefix('support')->name('support.')->group(function () {
    Route::get('/', [SupportController::class, 'faq'])->name('faq');
    Route::post('/contact', [SupportController::class, 'contact'])->name('contact');
});

/*
|--------------------------------------------------------------------------
| AUTH ROUTES
|--------------------------------------------------------------------------
*/

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Notifications
    Route::prefix('notifications')->name('notifications.')->group(function () {
        Route::get('/', [NotificationsController::class, 'index'])->name('index');
        Route::post('/read/{id}', [NotificationsController::class, 'markAsRead'])->name('read');
        Route::post('/read-all', [NotificationsController::class, 'markAllAsRead'])->name('readAll');
    });
});

/*
|--------------------------------------------------------------------------
| ADMIN ROUTES (auth + role:admin)
|--------------------------------------------------------------------------
*/

Route::middleware(['auth', 'role:admin'])->prefix('admin')->group(function () {

    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

    // Users
    Route::resource('users', UserController::class);

    /*
    |--------------------------------------------------------------------------
    | POSTS (slug)
    |--------------------------------------------------------------------------
    */
    Route::prefix('posts')->name('posts.')->group(function () {
        Route::get('/', [PostController::class, 'index'])->name('index');
        Route::get('/create', [PostController::class, 'create'])->name('create');
        Route::post('/', [PostController::class, 'store'])->name('store');
        Route::get('/{post:slug}', [PostController::class, 'show'])->name('show');
        Route::get('/{post:slug}/edit', [PostController::class, 'edit'])->name('edit');
        Route::put('/{post:slug}', [PostController::class, 'update'])->name('update');
        Route::delete('/{post:slug}', [PostController::class, 'destroy'])->name('destroy');
        Route::patch('/{post:slug}/toggle-status', [PostController::class, 'toggleStatus'])->name('toggle-status');
        Route::get('/{post:slug}/export', [PostController::class, 'export'])->name('export');
    });

    /*
    |--------------------------------------------------------------------------
    | PRODUCTS (UTILISE ID → PAS SLUG)
    |--------------------------------------------------------------------------
    */
    Route::resource('products', ProductController::class);

    /*
    |--------------------------------------------------------------------------
    | AUTRES MODULES
    |--------------------------------------------------------------------------
    */

    Route::resource('ads', AdvertisementController::class);
    Route::resource('documents', DocumentController::class);
    Route::resource('faqs', FaqController::class);
    Route::resource('sponsors', SponsorController::class);
    Route::resource('categories', CategoryController::class);
    Route::resource('tags', TagController::class);

    // Partenaires (avec actions custom)
    Route::prefix('partners')->name('partners.')->group(function () {
        Route::get('/', [PartnerController::class, 'index'])->name('index');
        Route::get('/create', [PartnerController::class, 'create'])->name('create');
        Route::post('/', [PartnerController::class, 'store'])->name('store');
        Route::get('/{partner}', [PartnerController::class, 'show'])->name('show');
        Route::get('/{partner}/edit', [PartnerController::class, 'edit'])->name('edit');
        Route::put('/{partner}', [PartnerController::class, 'update'])->name('update');
        Route::delete('/{partner}', [PartnerController::class, 'destroy'])->name('destroy');

        Route::patch('/{partner}/toggle-status', [PartnerController::class, 'toggleStatus'])->name('toggle-status');
        Route::patch('/{partner}/toggle-featured', [PartnerController::class, 'toggleFeatured'])->name('toggle-featured');
        Route::get('/{partner}/export', [PartnerController::class, 'export'])->name('export');
    });

    // Tickets (admin only)
    Route::resource('tickets', TicketController::class)->except(['create', 'store']);

    // Settings
    Route::resource('settings', SettingController::class)->only(['index', 'edit', 'update']);
});

require __DIR__.'/auth.php';
