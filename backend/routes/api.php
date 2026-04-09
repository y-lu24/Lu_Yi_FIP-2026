<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ArtistController;
use App\Http\Controllers\PortfolioController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\AdminArtistController;
use App\Http\Controllers\Admin\AdminPortfolioController;
use App\Http\Controllers\Admin\ConsultationController;
use App\Http\Controllers\Admin\MessageController;

// Public routes
Route::get('/artists', [ArtistController::class, 'index']);
Route::get('/artists/{id}', [ArtistController::class, 'show']);

Route::get('/portfolio', [PortfolioController::class, 'index']);
Route::get('/portfolio/{id}', [PortfolioController::class, 'show']);

Route::post('/contact', [ContactController::class, 'store']);

// Customer auth routes
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout']);
Route::post('/register', [AuthController::class, 'register']);

// Admin auth routes
Route::post('/admin/login', [AuthController::class, 'login']);
Route::post('/admin/logout', [AuthController::class, 'logout']);

// Admin routes
Route::prefix('admin')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index']);

    Route::get('/artists', [AdminArtistController::class, 'index']);
    Route::post('/artists', [AdminArtistController::class, 'store']);
    Route::put('/artists/{id}', [AdminArtistController::class, 'update']);
    Route::delete('/artists/{id}', [AdminArtistController::class, 'destroy']);

    Route::get('/portfolio', [AdminPortfolioController::class, 'index']);
    Route::post('/portfolio', [AdminPortfolioController::class, 'store']);
    Route::put('/portfolio/{id}', [AdminPortfolioController::class, 'update']);
    Route::delete('/portfolio/{id}', [AdminPortfolioController::class, 'destroy']);

    Route::get('/consultations', [ConsultationController::class, 'index']);
    Route::put('/consultations/{id}', [ConsultationController::class, 'update']);

    Route::get('/messages', [MessageController::class, 'index']);
    Route::put('/messages/{id}', [MessageController::class, 'update']);
});