<?php

use App\Http\Controllers\MarketingController;
use App\Http\Controllers\PortalController;
use Illuminate\Support\Facades\Route;

Route::get('/', [MarketingController::class, 'home'])->name('home');
Route::get('/features', [MarketingController::class, 'features'])->name('features');
Route::get('/modules', [MarketingController::class, 'modules'])->name('modules');
Route::get('/overtime', [MarketingController::class, 'overtime'])->name('overtime');
Route::get('/filings', [MarketingController::class, 'filings'])->name('filings');
Route::get('/pricing', [MarketingController::class, 'pricing'])->name('pricing');
Route::get('/security', [MarketingController::class, 'security'])->name('security');
Route::get('/demo', [MarketingController::class, 'demo'])->name('demo');

Route::middleware('auth')->group(function () {
    Route::get('/portal', [PortalController::class, 'index'])->name('portal.index');
});
