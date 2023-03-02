<?php

use App\Http\Controllers\SeriesController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::prefix('series')->group(function () {
    Route::get('/', [SeriesController::class,'index']);
    Route::get('/criar', [SeriesController::class,'create']);
    Route::post('/salvar', [SeriesController::class,'save']);
});
