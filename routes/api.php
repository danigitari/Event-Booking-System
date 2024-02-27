<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


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


Route::post('/login', [\App\Http\Controllers\AuthController::class, 'login']);
Route::post('/register', [\App\Http\Controllers\AuthController::class, 'register']);

Route::group(['middleware' => ['auth:sanctum']], function () {
    Route::group(['middleware' => ['role:admin']], function () {
        Route::post('/addNewAdmin', [\App\Http\Controllers\AdminController::class, 'addNewAdmin']);
        Route::post('/addNewEvent', [\App\Http\Controllers\AdminController::class, 'addNewEvent']);
        Route::match(['PATCH', 'PUT'], '/editEvent/{id}', [\App\Http\Controllers\AdminController::class, 'editEvent']);
        Route::delete('/deleteEvent/{id}', [\App\Http\Controllers\AdminController::class, 'deleteEvent']);
        Route::post('/defineTicketPrice', [\App\Http\Controllers\AdminController::class, 'defineTicketPrice']);
        Route::post('/createTickets', [\App\Http\Controllers\AdminController::class, 'createTickets']);

    });

    Route::post('/logout', [\App\Http\Controllers\AuthController::class, 'logout']);
    Route::post('/editProfile', [\App\Http\Controllers\AuthController::class, 'editProfile']);
    Route::get('/getCurrentUser', [\App\Http\Controllers\AuthController::class, 'getCurrentUser']);
    Route::get('/getEvents', [\App\Http\Controllers\EventsController::class, 'getEvents']);
    Route::get('/getEvent/{id}', [\App\Http\Controllers\EventsController::class, 'getEvent']);
    Route::post('/buyTicket', [\App\Http\Controllers\TicketsController::class, 'buyTicket']);





    // Route::get('/getCredentials/{id}', [\App\Http\Controllers\UserController::class, 'getCredential']);

});
