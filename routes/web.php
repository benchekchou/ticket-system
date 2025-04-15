<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\TicketController;
use App\Http\Controllers\ReplyController;


// Supprimer toutes les routes qui pointent vers React
Route::get('/', function () {
    return response()->json([
        'message' => 'Bienvenue sur l\'API Ticket System',
        'endpoints' => [
            'login' => '/api/login',
            'tickets' => '/api/tickets'
        ]
    ]);
});
Route::get('/{any}', function () {
    return view('app');
})->where('any', '.*');
Route::get('/', [AuthController::class, 'login']);
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth:sanctum');

Route::middleware('auth:sanctum')->group(function () {
    Route::apiResource('tickets', TicketController::class)->except(['update']);
    Route::put('/tickets/{ticket}/status', [TicketController::class, 'updateStatus']);
    Route::post('/tickets/{ticket}/replies', [ReplyController::class, 'store']);
});
