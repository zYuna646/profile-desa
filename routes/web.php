<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\LandingPageController;
use Illuminate\Support\Facades\Route;

Route::get('/', [LandingPageController::class, 'index'])->name('home');

Route::get('/organisasi', [App\Http\Controllers\OrganizationController::class, 'index'])->name('organization');
Route::get('/staff/{staff}', [App\Http\Controllers\OrganizationController::class, 'show'])->name('staff.show');

Route::name('umkm.')->group(function () {
    Route::get('/umkm', [Landing\UmkmController::class, 'index'])->name('index');
    Route::get('/umkm/{umkm:slug}', [Landing\UmkmController::class, 'show'])->name('show');
});

// Landing page news routes
Route::get('/berita', [App\Http\Controllers\Landing\NewsController::class, 'index'])->name('landing.news.index');
Route::get('/berita/{slug}', [App\Http\Controllers\Landing\NewsController::class, 'show'])->name('landing.news.show');

// Landing page gallery routes
Route::get('/galeri', [App\Http\Controllers\Landing\GalleryController::class, 'index'])->name('landing.galleries.index');
Route::get('/galeri/{gallery}', [App\Http\Controllers\Landing\GalleryController::class, 'show'])->name('landing.galleries.show');

// Landing page infographic routes
Route::get('/infografis', [App\Http\Controllers\Landing\InfographicController::class, 'index'])->name('landing.infographics.index');
Route::get('/infografis/tipe/{typeSlug}', [App\Http\Controllers\Landing\InfographicController::class, 'byType'])->name('landing.infographics.byType');
Route::get('/infografis/{slug}', [App\Http\Controllers\Landing\InfographicController::class, 'show'])->name('landing.infographics.show');

// Landing page service routes
Route::get('/layanan', [App\Http\Controllers\Landing\ServiceController::class, 'index'])->name('landing.services.index');
Route::get('/layanan/{id}', [App\Http\Controllers\Landing\ServiceController::class, 'show'])->name('landing.services.show');
Route::get('/layanan/{id}/form', [App\Http\Controllers\Landing\ServiceController::class, 'form'])->name('landing.services.form');
Route::post('/layanan/{id}/generate', [App\Http\Controllers\Landing\ServiceController::class, 'generateDocument'])->name('landing.services.generate');

// Landing page UMKM routes
Route::get('/umkm', [App\Http\Controllers\UmkmController::class, 'index'])->name('umkm.index');
Route::get('/umkm/{umkm:slug}', [App\Http\Controllers\UmkmController::class, 'show'])->name('umkm.show');

Route::get('/dashboard', [DashboardController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

// Admin routes
Route::middleware(['auth', 'role:admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'adminDashboard'])->name('dashboard');
    Route::get('/users', function() { return view('admin.dashboard'); })->name('users');
    // News routes
    Route::resource('news', App\Http\Controllers\Admin\NewsController::class);
    Route::resource('news-categories', App\Http\Controllers\Admin\NewsCategoryController::class);
    
    // Services routes
    Route::resource('services', App\Http\Controllers\Admin\ServiceController::class);
    Route::get('services/{service}/generate-pdf', [App\Http\Controllers\Admin\ServiceController::class, 'generatePdf'])->name('services.generate-pdf');
    
    // Service Templates routes
    Route::resource('service-templates', App\Http\Controllers\Admin\ServiceTemplateController::class);
    Route::get('service-templates/{id}/download', [App\Http\Controllers\Admin\ServiceTemplateController::class, 'download'])->name('service-templates.download');
    Route::get('service-templates/{id}/variables', [App\Http\Controllers\Admin\ServiceTemplateController::class, 'extractVariables'])->name('service-templates.variables');
    
    // Potentials routes
    Route::resource('potentials', App\Http\Controllers\Admin\PotentialController::class);
    
    // Settings routes
    Route::get('/settings', [App\Http\Controllers\Admin\SettingController::class, 'index'])->name('settings.index');
    Route::post('/settings', [App\Http\Controllers\Admin\SettingController::class, 'update'])->name('settings.update');
    Route::get('/settings/initialize', [App\Http\Controllers\Admin\SettingController::class, 'initializeSettings'])->name('settings.initialize');
    
    // UMKM routes
    Route::resource('umkm', App\Http\Controllers\Admin\UmkmController::class);
Route::delete('umkm-images/{image}', [App\Http\Controllers\Admin\UmkmController::class, 'deleteImage'])->name('umkm.images.destroy');
    Route::resource('umkm/categories', App\Http\Controllers\Admin\UmkmCategoryController::class)->names('umkm.categories');
    
    // Gallery routes
    Route::resource('galleries', App\Http\Controllers\Admin\GalleryController::class);

    // Staff routes
    Route::resource('staff', App\Http\Controllers\Admin\StaffController::class);
    
    // Navigation routes
    Route::resource('navigations', App\Http\Controllers\Admin\NavigationController::class);
    
    // Infographic routes
    Route::resource('infographic-types', App\Http\Controllers\Admin\InfographicTypeController::class);
    Route::resource('infographics', App\Http\Controllers\Admin\InfographicController::class);
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
