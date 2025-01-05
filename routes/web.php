<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SubscriptionPlanController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified', 'check.subscription'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::get('subscription-plans/plans',[SubscriptionPlanController::class, 'plans'])->name('subscription-plans.plans');
});

Route::resource('subscription-plans', SubscriptionPlanController::class);

Route::post('subscription-plans/{subscriptionPlan}/subscribe', [SubscriptionPlanController::class, 'subscribe'])
    ->name('subscription-plans.subscribe');



require __DIR__.'/auth.php';
