<?php

use App\Http\Controllers\BoardController;
use App\Http\Controllers\CardController;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/export', [Controller::class, 'exportDB']);

Route::controller(BoardController::class)->group(function () {
    Route::get('/boards', 'index');
    Route::post('/boards', 'store');
    Route::delete('/boards/{board}', 'destroy');
});

Route::controller(CardController::class)->group(function () {
    Route::post('/cards', 'store');
    Route::put('/cards/update-all', 'updateAll');
    Route::put('/cards/{card}', 'update');
    Route::delete('/cards/{card}', 'destroy');
});
