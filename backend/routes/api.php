<?php

use App\Http\Controllers\ConfigurationController;
use App\Http\Controllers\DestinationController;
use App\Http\Controllers\OriginController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| RESTful API endpoints for the ZenRows Configuration Selector.
| All routes are prefixed with /api automatically.
|
*/

// Origins - Read-only endpoints for available scraping sources
Route::get('/origins', [OriginController::class, 'index']);

// Destinations - Read-only endpoints for available data targets
Route::get('/destinations', [DestinationController::class, 'index']);

// Configurations - CRUD operations for saved origin-destination pairs
Route::get('/configurations', [ConfigurationController::class, 'index']);
Route::post('/configurations', [ConfigurationController::class, 'store']);
Route::delete('/configurations/{id}', [ConfigurationController::class, 'destroy']);

