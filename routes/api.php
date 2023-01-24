<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\api\PembelianController;

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

Route::post('/create_barang', [PembelianController::class, 'CreateBarang']);
Route::post('/create_pembeli', [PembelianController::class, 'CreatePembeli']);
Route::post('/create_pembelian', [PembelianController::class, 'CreatePembelian']);
Route::get('/show_pembeli/{id}', [PembelianController::class, 'ShowPembeli']);
