<?php

use App\Models\Series;
use App\Models\Episode;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\SeriesControllerApi;

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

Route::apiResource('/series', SeriesControllerApi::class);

Route::get('/series/{series}/seasons', function (Series $series) {
    return $series->seasons;
});

Route::get('/series/{series}/episodes', function (Series $series) {
    return $series->episodes;
});

Route::patch('/episodes/{episode}', function(Episode $episode, Request $request) {
    $episode->whatched = $request->whatched;

    $episode->save();
    return $episode;
});
