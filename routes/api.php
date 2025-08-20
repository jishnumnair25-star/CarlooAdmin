<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
// use app\Http\Controllers\TicketController;

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
use App\Http\Controllers\Api\TicketController;

Route::prefix('tickets')->group(function () {
    Route::get('/', [TicketController::class, 'index']); // List all tickets
    Route::post('/', [TicketController::class, 'store']); // Create ticket
    Route::get('/{id}', [TicketController::class, 'show']); // Get ticket details
    Route::post('/{id}/reply', [TicketController::class, 'reply']); // Reply to ticket
    Route::get('/{ticketId}/attachment/{attachmentId}', [TicketController::class, 'downloadAttachment']); // Download attachment
});

Route::get('departments', [TicketController::class, 'departments']); // List departments
