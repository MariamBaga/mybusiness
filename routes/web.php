<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use Spatie\Permission\Middleware\RoleMiddleware;
use App\Http\Controllers\Web\PageController;
use App\Http\Controllers\Web\HomeController;
use App\Http\Controllers\Web\BlogController;
use App\Http\Controllers\Web\SupportController;



//admin controllers
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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});




//admin routes


// Gestion utilisateurs
Route::resource('admin/users', UserController::class);

Route::middleware(['auth', 'role:admin'])->group(function () {
     Route::get('/admin', [DashboardController::class, 'index'])->name('admin.dashboard');


     Route::resource('/admin/posts', PostController::class);
    Route::resource('/admin/ads', AdvertisementController::class);
    Route::resource('/admin/products', ProductController::class);
    Route::resource('/admin/partners', PartnerController::class);
    Route::resource('/admin/documents', DocumentController::class);
    Route::resource('/admin/faqs', FaqController::class);




// Gestion sponsors
Route::resource('admin/sponsors', SponsorController::class);

// Blog catégories et tags
Route::resource('admin/categories', CategoryController::class);
Route::resource('admin/tags', TagController::class);

// Tickets support
Route::resource('admin/tickets', TicketController::class)->except(['create','store']);
// Tickets créés par le public via le formulaire, donc pas besoin de create/store dans admin

// Paramètres du site
Route::resource('admin/settings', SettingController::class)->only(['index','edit','update']);
});




Route::middleware(['auth'])->group(function () {

    // Liste des notifications
    Route::get('/notifications', [NotificationsController::class, 'index'])
        ->name('notifications.index');

    // Marquer une notification comme lue
    Route::post('/notifications/read/{id}', [NotificationsController::class, 'markAsRead'])
        ->name('notifications.read');

    // Marquer toutes les notifications comme lues
    Route::post('/notifications/read-all', [NotificationsController::class, 'markAllAsRead'])
        ->name('notifications.readAll');
});
//user-facing routes

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::get('/about', [PageController::class, 'about']);
Route::get('/features', [PageController::class, 'features']);
Route::get('/pricing', [PageController::class, 'pricing']);
Route::get('/downloads', [PageController::class, 'downloads']);
Route::get('/partners', [PageController::class, 'partners']);
Route::get('/legal', [PageController::class, 'legal']);
Route::get('/privacy', [PageController::class, 'privacy']);

Route::get('/blog', [BlogController::class, 'index']);
Route::get('/blog/{slug}', [BlogController::class, 'show']);

Route::get('/support', [SupportController::class, 'faq']);
Route::post('/contact', [SupportController::class, 'contact'])->name('contact');


require __DIR__.'/auth.php';
