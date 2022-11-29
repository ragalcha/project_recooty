<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProjectController;

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

Route::get('/', [ProjectController::class, 'index']);
Route::get('/searching', [ProjectController::class, 'search']);
Route::post('/register', [ProjectController::class, 'store']);
Route::post('/login', [ProjectController::class, 'login']);
Route::get('/friends/{id}', [ProjectController::class, 'friends']);
Route::get('/confirme/{id}', [ProjectController::class, 'confirme']);
Route::get('/reject/{id}', [ProjectController::class, 'reject']);
Route::get('/home', [ProjectController::class, 'home']);
Route::get('/logout', function () {
    if(session()->has('email'))
    { 
        session()->pull('email',null);
        session()->pull('id',null);
        session()->pull('name',null);
    }
    return redirect('/');
});


