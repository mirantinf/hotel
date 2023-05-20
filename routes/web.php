<?php

use App\Models\Menu;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\Tamu\MyBookingList;
use App\Http\Controllers\KamarListController;
use App\Http\Controllers\Admin\FkamarController;
use App\Http\Controllers\Tamu\BookingController;
use App\Http\Controllers\Admin\LaporanController;
use App\Http\Controllers\Admin\TipeKamarController;
use App\Http\Controllers\Admin\BarangKamarController;
use App\Http\Controllers\Admin\AdminDashboardController;
use App\Http\Controllers\Resepsionis\LaporanRepController;
use App\Http\Controllers\Resepsionis\RestaurantController;
use App\Http\Controllers\Resepsionis\BookingListController;


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
    return view('home', [
        "title" => "Home"
    ]);
});

Route::get('/about', function () {
    return view('facility', [
        "title" => "Facility"
    ]);
});

Route::get('/kontak', function () {
    return view('kontak', [
        "title" => "Contact"
    ]);
});

Route::get('restaurant', function(){
    $menus = Menu::orderBy('nama_menu')->get();
    $title = 'Restaurant';
    return view('restaurant', compact('menus', 'title'));
});
Route::get('/tipeKamar', [KamarListController::class, 'index']);
Route::get('/tipeKamar/{id:id}', [KamarListController::class, 'show']);

Route::get('/register', [RegisterController::class, 'index'])->middleware('guest');

Route::post('/register', [RegisterController::class, 'store']);


Route::get('/login', [LoginController::class, 'index'])->name('login')->middleware('guest');

Route::post('/login', [LoginController::class, 'authenticate']);

Route::post('/logout', [LoginController::class, 'logout'])->middleware('auth');


Route::get('/admin', [AdminDashboardController::class, 'index'])->middleware(['auth', 'admin']);
Route::resource('/admin/fasilitas-kamar', FkamarController::class)->except('show')->middleware(['auth', 'admin']);
Route::resource('/admin/barang-kamar', BarangKamarController::class)->except('show')->middleware(['auth', 'admin']);
Route::resource('/admin/tipe-kamar', TipeKamarController::class)->except('show')->middleware(['auth', 'admin']);

Route::get('/admin/laporan', [LaporanController::class, 'index'])->middleware(['auth', 'admin']);

Route::get('/resepsionis', [BookingListController::class, 'index'])->middleware(['auth', 'resepsionis']);
Route::post('/resepsionis', [BookingListController::class, 'search'])->middleware(['auth', 'resepsionis']);
Route::post('/resepsionis/bayar', [BookingListController::class, 'bayar'])->middleware(['auth', 'resepsionis']);
Route::post('/resepsionis/checkin', [BookingListController::class, 'checkin'])->middleware(['auth', 'resepsionis']);
Route::post('/resepsionis/checkout', [BookingListController::class, 'checkout'])->middleware(['auth', 'resepsionis']);

Route::get('/resepsionis/laporan', [LaporanRepController::class, 'index'])->middleware(['auth', 'resepsionis']);

//restaurant
Route::get('/resepsionis/menu', [RestaurantController::class, 'menu'])->name('menu')->middleware(['auth', 'resepsionis']);
Route::get('/resepsionis/menu/{id}/detail', [RestaurantController::class, 'menuDetail'])->name('menu.detail')->middleware(['auth', 'resepsionis']);
Route::put('/resepsionis/menu/{id}/update', [RestaurantController::class, 'updateMenu'])->name('menu.update')->middleware(['auth', 'resepsionis']);

//transaction
Route::get('/resepsionis/restaurant-transaksi', [RestaurantController::class, 'transaksi'])->name('transaksi')->middleware(['auth', 'resepsionis']);
Route::post('/resepsionis/restaurant-transaksi-store', [RestaurantController::class, 'transaksiStore'])->name('transaksi-store')->middleware(['auth', 'resepsionis']);
Route::put('/resepsionis/restaurant-transaksi-update/{no_transaksi}', [RestaurantController::class, 'transaksiUpdate'])->name('transaksi-update')->middleware(['auth', 'resepsionis']);
Route::get('/resepsionis/restaurant-transaksi-detail/{no_transaksi}', [RestaurantController::class, 'transaksiDetail'])->name('transaksi-detail')->middleware(['auth', 'resepsionis']);

Route::get('/booking/{id:id}', [BookingController::class, 'createID']);
Route::post('/booking', [BookingController::class, 'store']);
Route::get('/mybookinglist/{user_id}', [MyBookingList::class, 'show']);
Route::get('/mybookinglist-print/{id}', [MyBookingList::class, 'print']);

Route::get('lang/{lang}', ['as' => 'lang.switch', 'uses' => 'App\Http\Controllers\LanguageController@switchLang']);

