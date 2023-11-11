<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PretvoriValutaController;
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

Route::get('/pretvori', [PretvoriValutaController::class, 'pretvori']); // orginalen primer so get
Route::post('/convert', [PretvoriValutaController::class, 'convert']); // primer  so post
Route::get('/select_option', [PretvoriValutaController::class, 'selektiranaValuta']); // orginalen primer so get
Route::get('sitePodatoci', [PretvoriValutaController::class, 'sitePodatoci']);// json sto vrakja od strana