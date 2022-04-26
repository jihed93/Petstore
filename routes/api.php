<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PetController;
use App\Http\Controllers\JwtAuthController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/


Route::post('register', [JwtAuthController::class, 'register']);
Route::post('login', [JwtAuthController::class, 'login']);
Route::group([
    'middleware' => 'api',
    'prefix' => 'auth'
], function () {
    Route::post('logout', [JwtAuthController::class, 'logout']);
   
});
Route::get('pet/{id}', [PetController::class, 'findById']);
Route::post('pet/Add', [PetController::class, 'addNewPet']);
Route::delete('pet/deletePet/{id}', [PetController::class, 'deletePetById']);
Route::post('pet/uploadPhoto/{id}', [PetController::class, 'uploadImage']);