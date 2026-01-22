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
use App\Http\Controllers\Admin\AdminNotificationsController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\SponsorController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\TagController;
use App\Http\Controllers\Admin\TicketController;
use App\Http\Controllers\Admin\SettingController;

// Marketplace Controller
use App\Http\Controllers\Web\MarketplaceController;

// Advertisement Public Controller
use App\Http\Controllers\Web\AdvertisementPublicController;

// Ticket Public Controller
use App\Http\Controllers\Web\TicketPublicController;

// Client Controller
use App\Http\Controllers\Web\ClientController;
use App\Http\Controllers\Web\MemberAdvertisementController;
use App\Http\Controllers\Web\PartnerDashboardController;
use App\Http\Controllers\Web\PartnerProductController;
use App\Http\Controllers\Web\SeoController;

// Notifications Controller (public)
use App\Http\Controllers\Web\NotificationsController;

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
    Route::get('/cookies', [PageController::class, 'cookies'])->name('pages.cookies');
    Route::get('/gdpr', [PageController::class, 'gdpr'])->name('pages.gdpr');
    Route::get('/testimonials', [PageController::class, 'testimonials'])->name('pages.testimonials');
    Route::get('/case-studies', [PageController::class, 'caseStudies'])->name('pages.case-studies');
    Route::get('/demo', [PageController::class, 'demo'])->name('pages.demo');
    Route::get('/sponsors', [PageController::class, 'sponsors'])->name('pages.sponsors');
});

// Blog public
Route::prefix('blog')->name('blog.')->group(function () {
    Route::get('/', [BlogController::class, 'index'])->name('index');
    Route::get('/{slug}', [BlogController::class, 'show'])->name('show');
});

// Support public
// Support public
Route::prefix('support')->name('support.')->group(function () {
    Route::get('/', [SupportController::class, 'faq'])->name('faq');
    Route::get('/contact', [SupportController::class, 'showContactForm'])->name('contact');
    Route::post('/contact', [SupportController::class, 'contact'])->name('contact.submit');
    Route::get('/guides', [SupportController::class, 'guides'])->name('guides'); // ✅ Cette route existe
    Route::get('/guides/category/{category}', [SupportController::class, 'guidesByCategory'])->name('guides.category');
    Route::get('/guides/beginner', [SupportController::class, 'beginnerGuide'])->name('guides.beginner');
    Route::get('/guides/videos', [SupportController::class, 'videos'])->name('guides.videos');
    Route::get('/guides/{slug}', [SupportController::class, 'showGuide'])->name('guides.show');
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

    // Notifications (utilise le contrôleur Web)
    Route::prefix('notifications')->name('notifications.')->group(function () {
         Route::get('/', [AdminNotificationsController::class, 'index'])->name('index');

        Route::post('/read/{id}', [NotificationsController::class, 'markAsRead'])->name('read');
        Route::post('/read-all', [NotificationsController::class, 'markAllAsRead'])->name('readAll');
        Route::get('/count', [NotificationsController::class, 'count'])->name('count');
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

    // Posts
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

    // Products
  // Dans la section admin (~lignes 100-110)
Route::prefix('products')->name('products.')->group(function () {
    Route::get('/', [ProductController::class, 'index'])->name('index');
    Route::get('/create', [ProductController::class, 'create'])->name('create');
    Route::post('/', [ProductController::class, 'store'])->name('store');
    Route::get('/{product:slug}', [ProductController::class, 'show'])->name('show'); // Slug
    Route::get('/{product:slug}/edit', [ProductController::class, 'edit'])->name('edit'); // Slug
    Route::put('/{product:slug}', [ProductController::class, 'update'])->name('update'); // Slug
    Route::delete('/{product:slug}', [ProductController::class, 'destroy'])->name('destroy'); // Slug
});

    // Other modules
    Route::resource('ads', AdvertisementController::class);
    Route::resource('documents', DocumentController::class);
    Route::get('documents/{document}/download', [DocumentController::class, 'download'])->name('documents.download');
    Route::resource('faqs', FaqController::class);
    Route::post('/faqs/update-order', [FaqController::class, 'updateOrder'])->name('faqs.updateOrder');
    Route::resource('sponsors', SponsorController::class);
    Route::post('/sponsors/update-order', [SponsorController::class, 'updateOrder'])->name('sponsors.updateOrder');
    Route::resource('categories', CategoryController::class);
    Route::resource('tags', TagController::class);

    // Partners
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

    // Tickets
    Route::resource('tickets', TicketController::class);
    Route::post('/tickets/{ticket}/reply', [TicketController::class, 'reply'])->name('tickets.reply');

    // Settings
    Route::resource('settings', SettingController::class)->only(['index', 'edit', 'update']);
});

/*
|--------------------------------------------------------------------------
| MARKETPLACE PUBLIC
|--------------------------------------------------------------------------
*/
Route::prefix('marketplace')->name('marketplace.')->group(function () {
    Route::get('/', [MarketplaceController::class, 'index'])->name('index');
    Route::get('/{product}', [MarketplaceController::class, 'show'])->name('show');
});

/*
|--------------------------------------------------------------------------
| ADVERTISEMENT PUBLIC
|--------------------------------------------------------------------------
*/
// Après les routes existantes pour advertise
Route::prefix('advertise')->name('advertise.')->group(function () {
    Route::get('/', [AdvertisementPublicController::class, 'index'])->name('index');
    Route::get('/ads', [AdvertisementPublicController::class, 'showAds'])->name('ads');
    Route::get('/ad/{ad}', [AdvertisementPublicController::class, 'showAd'])->name('show');
    Route::get('/create', [AdvertisementPublicController::class, 'create'])->name('create');
    Route::post('/', [AdvertisementPublicController::class, 'store'])->name('store');
    Route::get('/payment/{ad}', [AdvertisementPublicController::class, 'payment'])->name('payment');
    Route::post('/payment/{ad}/process', [AdvertisementPublicController::class, 'processPayment'])->name('payment.process');
    Route::get('/pricing', [AdvertisementPublicController::class, 'pricing'])->name('pricing');
});

/*
|--------------------------------------------------------------------------
| TICKETS PUBLIC
|--------------------------------------------------------------------------
*/
Route::prefix('tickets')->name('tickets.')->group(function () {
    Route::get('/', [TicketPublicController::class, 'index'])->middleware('auth')->name('index');
    Route::get('/create', [TicketPublicController::class, 'create'])->name('create');
    Route::post('/', [TicketPublicController::class, 'store'])->name('store');
    Route::get('/{ticket}', [TicketPublicController::class, 'show'])->middleware('auth')->name('show');
    Route::post('/{ticket}/reply', [TicketPublicController::class, 'reply'])->middleware('auth')->name('reply');
    Route::post('/{ticket}/close', [TicketPublicController::class, 'close'])->middleware('auth')->name('close');
    Route::get('/check-new', [TicketPublicController::class, 'checkNew'])->middleware('auth')->name('check-new');
});

/*
|--------------------------------------------------------------------------
| CLIENT SPACE
|--------------------------------------------------------------------------
*/
Route::prefix('client')->middleware('auth')->name('client.')->group(function () {
    Route::get('/dashboard', [ClientController::class, 'dashboard'])->name('dashboard');
    Route::get('/profile', [ClientController::class, 'profile'])->name('profile');
    Route::put('/profile', [ClientController::class, 'updateProfile'])->name('profile.update');
    Route::get('/billing', [ClientController::class, 'billing'])->name('billing');
    Route::get('/documents', [ClientController::class, 'documents'])->name('documents');
    Route::get('/notifications', [ClientController::class, 'notifications'])->name('notifications');
    Route::delete('/notifications/{notification}', [ClientController::class, 'deleteNotification'])->name('notifications.delete');
    Route::post('/notifications/clear', [ClientController::class, 'clearNotifications'])->name('notifications.clear');
    Route::post('/notifications/settings', [ClientController::class, 'updateNotificationSettings'])->name('notifications.settings');
});

/*
|--------------------------------------------------------------------------
| MEMBER ADVERTISEMENTS
|--------------------------------------------------------------------------
*/
Route::prefix('member/ads')->middleware(['auth', 'role:member'])->name('member.ads.')->group(function () {
    Route::get('/', [MemberAdvertisementController::class, 'index'])->name('index');
    Route::get('/create', [MemberAdvertisementController::class, 'create'])->name('create');
    Route::post('/', [MemberAdvertisementController::class, 'store'])->name('store');
    Route::get('/stats/{ad}', [MemberAdvertisementController::class, 'stats'])->name('stats');
    Route::get('/{ad}/edit', [MemberAdvertisementController::class, 'edit'])->name('edit');
    Route::put('/{ad}', [MemberAdvertisementController::class, 'update'])->name('update');
    Route::delete('/{ad}', [MemberAdvertisementController::class, 'destroy'])->name('destroy');
    Route::post('/{ad}/pause', [MemberAdvertisementController::class, 'pause'])->name('pause');
    Route::post('/{ad}/activate', [MemberAdvertisementController::class, 'activate'])->name('activate');
    Route::get('/{ad}/refresh', [MemberAdvertisementController::class, 'refreshStats'])->name('refresh');

    // Bulk actions
    Route::post('/bulk/activate', [MemberAdvertisementController::class, 'bulkActivate'])->name('bulk.activate');
    Route::post('/bulk/pause', [MemberAdvertisementController::class, 'bulkPause'])->name('bulk.pause');
    Route::post('/bulk/delete', [MemberAdvertisementController::class, 'bulkDelete'])->name('bulk.delete');
});

/*
|--------------------------------------------------------------------------
| PARTNER SPACE
|--------------------------------------------------------------------------
*/
Route::prefix('partner')->middleware(['auth', 'role:partner'])->name('partner.')->group(function () {
    // Dashboard
    Route::get('/dashboard', [PartnerDashboardController::class, 'index'])->name('dashboard');
    Route::get('/stats', [PartnerDashboardController::class, 'stats'])->name('stats');
    Route::get('/profile', [PartnerDashboardController::class, 'profile'])->name('profile');
    Route::put('/profile', [PartnerDashboardController::class, 'updateProfile'])->name('profile.update');

    // Partner products
    Route::prefix('products')->name('products.')->group(function () {
        Route::get('/', [PartnerProductController::class, 'index'])->name('index');
        Route::get('/create', [PartnerProductController::class, 'create'])->name('create');
        Route::post('/', [PartnerProductController::class, 'store'])->name('store');
        Route::get('/{product}', [PartnerProductController::class, 'show'])->name('show');
        Route::get('/{product}/edit', [PartnerProductController::class, 'edit'])->name('edit');
        Route::put('/{product}', [PartnerProductController::class, 'update'])->name('update');
        Route::delete('/{product}', [PartnerProductController::class, 'destroy'])->name('destroy');
        Route::patch('/{product}/toggle-status', [PartnerProductController::class, 'toggleStatus'])->name('toggle-status');
        Route::patch('/{product}/toggle-featured', [PartnerProductController::class, 'toggleFeatured'])->name('toggle-featured');
        Route::get('/{product}/analytics', [PartnerProductController::class, 'analytics'])->name('analytics');
    });

    // Partner documents (optionnel)
    Route::prefix('documents')->name('documents.')->group(function () {
        Route::get('/', [PartnerDashboardController::class, 'documents'])->name('index');
        Route::post('/upload', [PartnerDashboardController::class, 'uploadDocument'])->name('upload');
        Route::delete('/{document}', [PartnerDashboardController::class, 'deleteDocument'])->name('delete');
        Route::get('/{document}/download', [PartnerDashboardController::class, 'downloadDocument'])->name('download');
    });
});

/*
|--------------------------------------------------------------------------
| SEO PUBLIC ROUTES
|--------------------------------------------------------------------------
*/
Route::prefix('sitemap')->name('sitemap.')->group(function () {
    Route::get('/', [SeoController::class, 'sitemapIndex'])->name('index');
    Route::get('/pages', [SeoController::class, 'pages'])->name('pages');
    Route::get('/blog', [SeoController::class, 'blog'])->name('blog');
    Route::get('/products', [SeoController::class, 'products'])->name('products');
    Route::get('/categories', [SeoController::class, 'categories'])->name('categories');
});

Route::get('/sitemap.xml', [SeoController::class, 'sitemapIndex'])->name('sitemap.index');
Route::get('/sitemap/pages', [SeoController::class, 'pages'])->name('sitemap.pages');
Route::get('/sitemap/blog', [SeoController::class, 'blog'])->name('sitemap.blog');
Route::get('/sitemap/products', [SeoController::class, 'products'])->name('sitemap.products');
Route::get('/robots.txt', [SeoController::class, 'robots'])->name('robots');
Route::get('/manifest.json', [SeoController::class, 'manifest'])->name('manifest');

/*
|--------------------------------------------------------------------------
| AJAX/API ROUTES
|--------------------------------------------------------------------------
*/
Route::middleware('web')->group(function () {
    // Search routes
    Route::get('/search', [HomeController::class, 'search'])->name('search');
    Route::get('/search/blog', [BlogController::class, 'search'])->name('search.blog');
    Route::get('/search/products', [MarketplaceController::class, 'search'])->name('search.products');

    // Newsletter subscription
    Route::post('/newsletter/subscribe', [HomeController::class, 'subscribeNewsletter'])->name('newsletter.subscribe');

    // Contact form
    Route::post('/contact', [HomeController::class, 'contact'])->name('contact.submit');
});

/*
|--------------------------------------------------------------------------
| AUTHENTICATION ROUTES (Laravel Breeze/UI)
|--------------------------------------------------------------------------
*/
require __DIR__.'/auth.php';

