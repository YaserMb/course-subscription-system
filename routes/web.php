<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SubscriptionPlanController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\CourseController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Artisan;
Route::get('/', function () {
    return view('welcome');
});
Route::get('optimize', function(){
    Artisan::call('optimize:clear');
    Artisan::call('optimize');

    return 'optimized';
});

// User routes
Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::post('/courses/{course}/download', [CourseController::class, 'download'])->name('courses.download');
    Route::get('/courses/{course}/download/{token}', [CourseController::class, 'downloadFile'])
        ->middleware(['verify.download', 'active.subscription'])
        ->name('courses.download.file');

    // Subscription routes
});

// User routes
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::get('subscription-plans/plans',[SubscriptionPlanController::class, 'plans'])->name('subscription-plans.plans');
    Route::post('subscription-plans/{subscriptionPlan}/subscribe', [SubscriptionPlanController::class, 'subscribe'])->name('subscription-plans.subscribe');
});


// Admin routes
Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/', [App\Http\Controllers\Admin\AdminController::class, 'dashboard'])->name('dashboard');
    Route::get('/users', [App\Http\Controllers\Admin\AdminController::class, 'users'])->name('users');
    Route::get('/courses', [App\Http\Controllers\Admin\CourseController::class, 'index'])->name('courses');
    Route::resource('courses', App\Http\Controllers\Admin\CourseController::class);
});

require __DIR__.'/auth.php';
