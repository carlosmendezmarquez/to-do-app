<?php

use App\Http\Controllers\ToDoController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::get('/to-dos',[ToDoController::class,'index']);
Route::prefix('/to-do')->group( function (){
    Route::post('/store',[ToDoController::class, 'store']);
    Route::put('/{id}',[ToDoController::class, 'update']);
    Route::delete('/{id}',[ToDoController::class, 'destroy']);
});
Route::get('/to-dos/analytics',[ToDoController::class,'getAnalytics']);
