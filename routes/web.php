<?php

use App\Http\Controllers\SpotifyController;
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

Route::post('/get_songs', [SpotifyController::class, 'search_songs']);

Route::get('/test', function () {
    return view('test');
});

Route::post('/authenticate_spotify', [SpotifyController::class, 'connect_spotify']);

