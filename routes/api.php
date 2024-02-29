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
Route::get('/users', [\App\Http\Controllers\AdminController::class, 'getUsers']);

Route::group(['middleware' => ['auth:sanctum']], function () {
    Route::get('/getEvents', [\App\Http\Controllers\EventsController::class, 'getEvents']);
    Route::group(['middleware' => ['role:admin']], function () {
        Route::post('/addNewAdmin', [\App\Http\Controllers\AdminController::class, 'addNewAdmin']);
        Route::post('/addEvent', [\App\Http\Controllers\AdminController::class, 'createEvent']);
        Route::match(['PATCH', 'PUT'], '/editEvent/{id}', [\App\Http\Controllers\AdminController::class, 'editEvent']);
        Route::post('/deleteEvent', [\App\Http\Controllers\AdminController::class, 'deleteEvent']);
        Route::get('/getEvent/{id}', [\App\Http\Controllers\EventsController::class, 'getEvent']);
        Route::get('/getUsers', [\App\Http\Controllers\AdminController::class, 'getUsers']);
        Route::post('/editEvent', [\App\Http\Controllers\AdminController::class, 'editEvent']);
        // Route::post('/defineTicketPrice', [\App\Http\Controllers\AdminController::class, 'defineTicketPrice']);


    });

    Route::post('/logout', [\App\Http\Controllers\AuthController::class, 'logout']);
    Route::post('/editProfile', [\App\Http\Controllers\AuthController::class, 'editProfile']);
    Route::get('/getCurrentUser', [\App\Http\Controllers\AuthController::class, 'getCurrentUser']);

    Route::post('/buyTicket', [\App\Http\Controllers\EventsController::class, 'buyTicket']);





    // Route::get('/getCredentials/{id}', [\App\Http\Controllers\UserController::class, 'getCredential']);

});
