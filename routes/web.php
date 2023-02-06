<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\BoardController;
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

Route::controller(BoardController::class)->group(function () {
    Route::get('/boards', 'index');
    Route::post('/boards', 'store');
    Route::delete('/boards/{board}', 'destroy');
});