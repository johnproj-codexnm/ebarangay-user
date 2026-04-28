<?php

use App\Http\Controllers\ResidentDashboardController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ResidentComplaintController;
use App\Http\Controllers\ResidentAuthController;

Route::get('/', function () {
    return view('auth.login');
});


Route::get('/login',[ResidentAuthController::class,'showLogin']);

Route::post('/login',[ResidentAuthController::class,'login']);

Route::get('/register',[ResidentAuthController::class,'showRegister']);

Route::post('/register',[ResidentAuthController::class,'register']);

Route::get('/logout',[ResidentAuthController::class,'logout']);


Route::get('/dashboard',[ResidentDashboardController::class,'index']);


Route::get('/submit-complaint',[ResidentComplaintController::class,'create']);

Route::post('/submit-complaint',[ResidentComplaintController::class,'store']);

Route::get('/tickets',[ResidentComplaintController::class,'tickets']);

Route::get('/ticket/{id}',[ResidentComplaintController::class,'ticketDetails']);

Route::post('/send-message',[ResidentComplaintController::class,'sendMessage']);

Route::get('/dashboard', [ResidentDashboardController::class, 'index']);


Route::get('/messages/{id}', [ResidentComplaintController::class, 'getMessages']);
Route::post('/send-message', [ResidentComplaintController::class, 'sendMessage']);

Route::post('/delete-ticket', [ResidentComplaintController::class, 'deleteTicket']);