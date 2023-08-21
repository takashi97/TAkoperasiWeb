<?php

use App\Mail\ReminderMail;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Mail;
use App\Http\Middleware\ChecksMember;
use App\Http\Middleware\ChecksUser;
use App\Http\Middleware\ChecksUmkm;
use App\Http\Middleware\ChecksAdmin;
use App\Http\Controllers\ShowsimpananController;
use App\Http\Controllers\ShowpinjamanController;
use App\Http\Controllers\ShowpenarikanController;
use App\Http\Controllers\TopupapprovalController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\ProductController;
use App\Http\MailController;




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
Route::middleware('auth:sanctum')->get('/api/token', function (Request $request) {
    $user = $request->user();
    $token = $user->createToken('API Token')->plainTextToken;
    return ['token' => $token];
});
Auth::routes();
Route::middleware([ChecksAdmin::Class, 'auth'])->group(function () {
            /*
                |--------------------------------------------------------------------------
                | Khusus Admin Aja
                |--------------------------------------------------------------------------
            */
        Route::get('/', [MailController::class, 'sendMail']);
        
        Route::get('/koperasihome', function () {
            return view('koperasi.koperasihome');
        });
        Route::get('/koperasihomepageadmin', function () {
            return view('koperasi.koperasihomepageadmin');
        });

        Route::get('/koperasihome', 'App\Http\Controllers\SimpanapprovalController@index')->name('koperasihome');
        Route::post('/simpanapproval/{id}/approve','App\Http\Controllers\SimpanapprovalController@approve')->name('simpanapproval.approve');
        Route::post('/simpanapproval/{id}/reject', 'App\Http\Controllers\SimpanapprovalController@reject')->name('simpanapproval.reject');
        
        Route::get('/koperasisimpan', 
        [ShowsimpananController::class, 'index'])
        ->name('koperasisimpan');

        Route::post('/pinjamapproval/{id}/approve','App\Http\Controllers\PinjamapprovalController@approve')->name('pinjamapproval.approve');
        Route::post('/pinjamapproval/{id}/reject', 'App\Http\Controllers\PinjamapprovalController@reject')->name('pinjamapproval.reject');

        Route::get('/koperasipinjam', 
        [ShowpinjamanController::class, 'index2'])
        ->name('koperasipinjam');

        Route::post('/penarikanapproval/{id}/approve','App\Http\Controllers\PenarikanapprovalController@approve')->name('penarikanapproval.approve');
        Route::post('/penarikanapproval/{id}/reject', 'App\Http\Controllers\PenarikanapprovalController@reject')->name('penarikanapproval.reject');
        
        Route::get('/koperasipenarikan', 
        [ShowpenarikanController::class, 'index3'])
        ->name('koperasipenarikan');

        Route::post('/topupapproval/{id}/approve','App\Http\Controllers\TopupapprovalController@approve')->name('topupapproval.approve');
        Route::post('/topupapproval/{id}/reject', 'App\Http\Controllers\TopupapprovalController@reject')->name('topupapproval.reject');

        Route::get('/koperasilaporan', 
        [ShowsimpananController::class, 'index3'])
        ->name('koperasilaporan');

        Route::get('/koperasianggota', 
        [ShowsimpananController::class, 'showanggota'])
        ->name('koperasianggota');
});

Route::middleware([ChecksMember::Class, 'auth'])->group(function () {
    /*
        |--------------------------------------------------------------------------
        | Khusus Admin dan Member
        |--------------------------------------------------------------------------
    */
    Route::get('/koperasiproses', function () {
        return view('koperasi.koperasiproses');
    });

    


});

Route::middleware([ChecksUser::Class, 'auth'])->group(function () {
    /*
    |--------------------------------------------------------------------------
    | Khusus Admin, Member dan User
    |--------------------------------------------------------------------------
    */

    Route::get('/mpkatmakanan', 'App\Http\Controllers\ProductController@showMpkatmakananPage')->name('mpkatmakanan');
    
    Route::get('/mpkatpakaian', 'App\Http\Controllers\ProductController@showMpkatpakaianPage')->name('mpkatpakaian');

    Route::get('/mpkataksesoris', 'App\Http\Controllers\ProductController@showMpkataksesorisPage')->name('mpkataksesoris');


    Route::get('/mpdashboard', [CartController::class, 'showMpTransaction'])->name('mpdashboard');
    Route::get('/mpformalamat', function () {
        return view('koperasi.form.mpformalamat');
    });
    Route::get('/mpcartpage', function () {
        return view('marketplace.mpcartpage');
    });
    Route::get('/koperasitopup', 
    [TopupapprovalController::class, 'index4'])
    ->name('koperasitopup');
    Route::get('/produkpage/{identifier}', 'App\Http\Controllers\ProductController@showProductPage')->name('produkpage');
    /*dummy*/
    Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
    Route::post('/cart', [CartController::class, 'store'])->name('cart.store');
    Route::put('/cart/{id}', [CartController::class, 'update'])->name('cart.update');
    Route::delete('/cart/{id}', [CartController::class, 'destroy'])->name('cart.destroy');
    Route::get('/checkoutpage', [CartController::class, 'showMpcheckoutPage'])->name('checkoutpage.index');
    Route::post('/checkoutpage', [CartController::class, 'processMpcheckoutPage'])->name('checkoutpage.store');
    Route::put('/checkoutpage', [CartController::class, 'updateMpcheckoutPage'])->name('checkoutpage.update');

    
});
Route::middleware([ChecksUmkm::Class, 'auth'])->group(function () {
    /*
    |--------------------------------------------------------------------------
    | Khusus Admin, Member dan Umkm
    |--------------------------------------------------------------------------
    */
    Route::get('/koperasisimpanform', 'App\Http\Controllers\SimpanController@showSimpanForm')->name('simpan');
    Route::post('/koperasisimpanform', 'App\Http\Controllers\SimpanController@processSimpanForm')->name('simpan.post');

    Route::get('/koperasipinjamform', 'App\Http\Controllers\PinjamController@showPinjamForm')->name('pinjam');
    Route::post('/koperasipinjamform', 'App\Http\Controllers\PinjamController@processPinjamForm')->name('pinjam.post');

    Route::get('/koperasipenarikanform', function () {
        return view('koperasi.form.koperasipenarikanform');
    });
    Route::get('/koperasipenarikanform', 'App\Http\Controllers\PenarikanController@showPenarikanForm')->name('penarikan');
    Route::post('/koperasipenarikanform', 'App\Http\Controllers\PenarikanController@processPenarikanForm')->name('penarikan.post');
    
    Route::get('/mpsellform', 'App\Http\Controllers\ProductController@showMpsellForm')->name('mpsell');
    Route::post('/mpsellform', 'App\Http\Controllers\ProductController@processMpsellForm')->name('mpsell.post');
    
    Route::get('/mpprodukedit/{identifier}', 'App\Http\Controllers\ProductController@showupdateMpsellForm')->name('mpprodukedit');
    Route::post('/mpprodukedit/{identifier}', 'App\Http\Controllers\ProductController@updateMpsellForm')->name('mpprodukedit.post');
    Route::get('/mpprodukdelete/{identifier}', 'App\Http\Controllers\ProductController@showdeleteMpsellForm')->name('mpprodukdelete');
    Route::post('/mpprodukdelete/{identifier}', 'App\Http\Controllers\ProductController@deleteMpsellForm')->name('mpprodukdelete.post');
    Route::get('/mpsellpage', 'App\Http\Controllers\ProductController@showMpsellPage')->name('mpsellpage');

    

    Route::get('/koperasihomeuser', 
    [ShowsimpananController::class, 'index2'])
    ->name('koperasihomeuser');
});
/*
|--------------------------------------------------------------------------
| Semua bisa akses kecuali yang ada 'auth'
|--------------------------------------------------------------------------
*/
    Route::get('/search', [ProductController::class, 'search'])->name('search');
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home')->middleware('auth');
    Route::get('/daftarmember', 'App\Http\Controllers\DaftarController@showDaftarForm')->name('daftarmember')->middleware('auth','dfrole');
    Route::post('/daftarmember', 'App\Http\Controllers\DaftarController@processDaftarForm')->name('daftarmember.post')->middleware('auth','dfrole');
    Route::get('/daftarumkm', 'App\Http\Controllers\DaftarController@showDaftarForm')->name('daftarumkm')->middleware('auth','dfrole');
    Route::post('/daftarumkm', 'App\Http\Controllers\DaftarController@processDaftarForm')->name('daftarumkm.post')->middleware('auth','dfrole');
    
    Route::get('/marketplacehome', 'App\Http\Controllers\ProductController@showMprekomendasiPage')->name('marketplacehome');

    Route::get('/', function () {
        return view('mainpage');
    });
    Route::post('/update-umkm', [App\Http\Controllers\UpdateumkmController::class, 'updateUmkm'])->name('updateUmkm')->middleware('auth');

    Route::get('/topupform', 'App\Http\Controllers\TopupController@showTopupForm')->name('topup');
    Route::post('/topupform', 'App\Http\Controllers\TopupController@processTopupForm')->name('topup.post');

    //Route for mailing
    Route::get('/email', function () {
        Mail::to('jeanpaulferdinand2@gmail.com')->send(new ReminderMail);
        return new ReminderMail();
    });





    


