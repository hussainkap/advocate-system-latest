<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\EarningController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ReferralController;
use App\Http\Controllers\ReferralLinkController;
use App\Http\Controllers\SettingsController;
use App\Http\Controllers\TrackingController;
use Illuminate\Support\Facades\Route;

Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

Route::resource('referrals', ReferralController::class)->only([
    'index',
    'create',
    'show',
    'edit',
]);

Route::resource('orders', OrderController::class)->only([
    'index',
    'show',
]);

Route::get('/earnings', [EarningController::class, 'index'])->name('earnings.index');
Route::get('/links', [ReferralLinkController::class, 'index'])->name('links.index');
Route::get('/tracking', [TrackingController::class, 'index'])->name('tracking.index');
Route::get('/settings', [SettingsController::class, 'index'])->name('settings.index');
