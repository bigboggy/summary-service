<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use \App\Http\Controllers\ReviewSummaryController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


Route::get('/review-summary-requests/{roomId}', [ReviewSummaryController::class, 'index'])
    ->name('review-summary-requests.index');

Route::post(
    '/review-summary-requests/{roomId}',
    [ReviewSummaryController::class, 'store']
)->name('review-summary-requests.store');

