<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DaftarApiController;
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

Route::post('/penarikanform', 'App\Http\Controllers\KoperasiApiController@penarikanform')->name('penarikanform');
Route::post('/pinjamanform', 'App\Http\Controllers\KoperasiApiController@pinjamanform')->name('pinjamanform');
Route::post('/simpananform', 'App\Http\Controllers\KoperasiApiController@simpananform')->name('simpananform');
Route::get('/showsimpanan/{userId}', 'App\Http\Controllers\KoperasiApiController@showsimpanan')->name('showsimpanan');
Route::get('/showpinjaman/{userId}', 'App\Http\Controllers\KoperasiApiController@showpinjaman')->name('showpinjaman');
Route::get('/showpenarikan/{userId}', 'App\Http\Controllers\KoperasiApiController@showpenarikan')->name('showpenarikan');
Route::post('/addproduk', 'App\Http\Controllers\ProductApiController@addproduk')->name('addproduk');
Route::post('/topup', 'App\Http\Controllers\TopupApiController@topupform')->name('topup');
Route::get('/getjumsimpanan/{userId}', 'App\Http\Controllers\KoperasiApiController@getjumsimpanan')->name('getjumsimpanan');
Route::get('/saldo/{userId}', 'App\Http\Controllers\SaldoApiController@show')->name('saldo');
Route::post('/test', 'App\Http\Controllers\ProductApiController@test')->name('test');
Route::post('/daftarmemberapi/{id}', [DaftarApiController::class, 'processDaftarMemberForm'])->name('daftarmemberapi');
Route::post('/daftarumkmapi/{id}', [DaftarApiController::class, 'processDaftarUMKMForm'])->name('daftarumkmapi');
Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
