<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SubscriptionPlanController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\CourseController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', [DashboardController::class, 'index'])->middleware(['auth', 'verified', 'check.subscription'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::get('subscription-plans/plans',[SubscriptionPlanController::class, 'plans'])->name('subscription-plans.plans');
    Route::post('subscription-plans/{subscriptionPlan}/subscribe', [SubscriptionPlanController::class, 'subscribe'])->name('subscription-plans.subscribe');
    Route::post('/courses/{course}/download', [CourseController::class, 'download'])->name('courses.download');
});

Route::resource('subscription-plans', SubscriptionPlanController::class);

Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/', [App\Http\Controllers\Admin\AdminController::class, 'dashboard'])->name('dashboard');
    Route::get('/users', [App\Http\Controllers\Admin\AdminController::class, 'users'])->name('users');
    Route::get('/courses', [App\Http\Controllers\Admin\CourseController::class, 'index'])->name('courses');
    Route::resource('courses', App\Http\Controllers\Admin\CourseController::class);
});

require __DIR__.'/auth.php';
