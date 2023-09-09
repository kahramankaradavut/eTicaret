<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AjaxController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\Frontend\PageController;
use App\Http\Controllers\Frontend\PageHomeController;

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


Route::group(['middleware'=>'sitesetting'], function() {

    Route::get('/', [PageHomeController::class,'anasayfa'])->name('anasayfa');

    Route::get('/urunler/{slug?}', [PageController::class,'urunler'])->name('urunler');
    // Route::get('/erkek/{slug?}', [PageController::class,'urunler'])->name('alt-giyimurunler');
    // Route::get('/kadin/{slug?}', [PageController::class,'urunler'])->name('ust-giyimurunler');
    // Route::get('/cocuk/{slug?}', [PageController::class,'urunler'])->name('dis-giyimurunler');
    // Route::get('/erkek/{slug?}', [PageController::class,'urunler'])->name('takimlarurunler');
    // Route::get('/erkek/{slug?}', [PageController::class,'urunler'])->name('aksesuarurunler');
    // Route::get('/erkek/{slug?}', [PageController::class,'urunler'])->name('ayakkabiurunler');



    Route::get('/urun/{slug}', [PageController::class,'urundetay'])->name('urundetay');

    Route::get('/hakkimizda', [PageController::class,'hakkimizda'])->name('hakkimizda');

    Route::get('/iletisim', [PageController::class,'iletisim'])->name('iletisim');

    Route::post('/iletisim/kaydet', [AjaxController::class,'iletisimkaydet'])->name('iletisim.kaydet');

    Route::get('/sepet', [CartController::class,'index'])->name('sepet');
    Route::get('/sepet/form', [CartController::class,'sepetform'])->name('sepet.form');

    Route::post('/sepet/ekle', [CartController::class,'add'])->name('sepet.add');
    Route::post('/sepet/remove', [CartController::class,'remove'])->name('sepet.remove');
    Route::post('/sepet/couponcheck', [CartController::class,'couponcheck'])->name('coupon.check');
    Route::post('/sepet/newqty', [CartController::class,'newqty'])->name('sepet.newqty');
    Route::post('/sepet/save', [CartController::class,'cartSave'])->name('sepet.cartSave');
    Route::get('/sepet/odeme', [CartController::class, 'odeme'])->name('odeme');
    Route::match(['get','post'], '/sepet/callback', [CartController::class, 'callback'])->name('call_back');



    Auth::routes();


    Route::get('/cikis', [AjaxController::class,'logout'])->name('cikis');
});

