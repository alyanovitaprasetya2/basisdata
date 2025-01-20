<?php

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

use App\Http\Controllers\HomeController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\UserProfileController;
use App\Http\Controllers\ResetPassword;
use App\Http\Controllers\ChangePassword;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\MejaController;
use App\Http\Controllers\PegawaiController;
use App\Http\Controllers\PelangganController;
use App\Http\Controllers\PenjualanController;
use App\Http\Controllers\ProdukController;
use App\Http\Controllers\RekapController;
use App\Http\Controllers\SuperController;

Route::get('/', function () {return redirect('/dashboard');})->middleware('auth');
	Route::get('/register', [RegisterController::class, 'create'])->middleware('guest')->name('register');
	Route::post('/register', [RegisterController::class, 'store'])->middleware('guest')->name('register.perform');
	Route::get('/login', [LoginController::class, 'show'])->middleware('guest')->name('login');
	Route::post('/login', [LoginController::class, 'login'])->middleware('guest')->name('login.perform');
	Route::get('/reset-password', [ResetPassword::class, 'show'])->middleware('guest')->name('reset-password');
	Route::post('/reset-password', [ResetPassword::class, 'send'])->middleware('guest')->name('reset.perform');
	Route::get('/change-password', [ChangePassword::class, 'show'])->middleware('guest')->name('change-password');
	Route::post('/change-password', [ChangePassword::class, 'update'])->middleware('guest')->name('change.perform');
	Route::get('/dashboard', [HomeController::class, 'index'])->name('home')->middleware('auth');

Route::group(['middleware' => 'auth'], function () {

	Route::get('nota/{id}', [RekapController::class, 'nota'])->name('nota');

	// SUPER ADMIN
	Route::prefix('/super')->group(function() {
		Route::get('/users', [SuperController::class, 'users'])->name('users');
		Route::get('/users/add', [SuperController::class, 'createUser'])->name('users.add');
		Route::post('/users/doCreate', [SuperController::class, 'doCreateUser'])->name('users.doCreate');

		Route::get('/tempat', [SuperController::class, 'tempat'])->name('tempat');
	});
	
	// KATEGORI
	Route::prefix('/kategori')->group(function() {
		Route::get('/list', [KategoriController::class, 'index'])->name('kategori');
		Route::get('/add', [KategoriController::class, 'add'])->name('add');
		Route::post('/do-create', [KategoriController::class, 'doCreate'])->name('doCreate');
	});
	// PRODUK
	Route::prefix('/produk')->group(function() {
		Route::get('/list', [ProdukController::class, 'index'])->name('produk');
		Route::get('/add', [ProdukController::class, 'add'])->name('produk.add');
		Route::get('/update/{id}', [ProdukController::class, 'update'])->name('produk.update');
		Route::put('/do-update/{id}', [ProdukController::class, 'doUpdate'])->name('produk.doUpdate');
		Route::delete('/delete/{id}', [ProdukController::class, 'delete'])->name('produk.delete');
		Route::post('/do-create', [ProdukController::class, 'doCreate'])->name('produk.create');
	});

	// PEGAWAI
	Route::prefix('/pegawai')->group(function() {
		Route::get('/list', [PegawaiController::class, 'index'])->name('pegawai');
		Route::get('/add', [PegawaiController::class, 'add'])->name('pegawai.add');
		Route::get('/update/{id}', [PegawaiController::class, 'update'])->name('pegawai.update');
		Route::put('/do-update/{id}', [PegawaiController::class, 'doUpdate'])->name('pegawai.doUpdate');
		Route::delete('/delete/{id}', [PegawaiController::class, 'delete'])->name('pegawai.delete');
		Route::post('/do-create', [PegawaiController::class, 'doCreate'])->name('pegawai.doCreate');
	});

	// Pelanggan/Member
	Route::prefix('/pelanggan')->group(function() {
		Route::get('/list', [PelangganController::class, 'index'])->name('pelanggan');
		Route::get('/add', [PelangganController::class, 'add'])->name('pelanggan.add');
		Route::get('/update/{id}', [PelangganController::class, 'update'])->name('pelanggan.update');
		Route::put('/do-update/{id}', [PelangganController::class, 'doUpdate'])->name('pelanggan.doUpdate');
		Route::delete('/delete/{id}', [PelangganController::class, 'delete'])->name('pelanggan.delete');
		Route::post('/do-create', [PelangganController::class, 'store'])->name('pelanggan.doCreate');
	});

	// REKAP PENJUALAN
	Route::prefix('/rekap')->group(function() {
		Route::get('/list', [RekapController::class, 'index'])->name('rekap');
		Route::get('/detail/{id}', [RekapController::class, 'detail'])->name('rekap.detail');
		Route::get('/update/{id}', [RekapController::class, 'update'])->name('rekap.update');
		Route::put('/do-update/{id}', [RekapController::class, 'doUpdate'])->name('rekap.doUpdate');
		Route::delete('/delete/{id}', [RekapController::class, 'delete'])->name('rekap.delete');
		Route::post('/do-create', [RekapController::class, 'doCreate'])->name('rekap.doCreate');
		Route::get('/export-excel', [RekapController::class, 'exportExcel'])->name('exportExcel');
	});
	
	// MEJA
	Route::prefix('/meja')->group(function() {
		Route::get('/index', [MejaController::class, 'index'])->name('meja');
		Route::put('/meja/{id}', [MejaController::class, 'update'])->name('meja.update');
	});

	//PENJUALAN
	Route::prefix('/penjualan')->group(function() {
		Route::get('/index', [PenjualanController::class, 'index'])->name('penjualan');
		Route::post('/add', [PenjualanController::class, 'store'])->name('penjualan.add');
	});

	Route::prefix('/profile')->group(function() {
		Route::get('/profile', [UserProfileController::class, 'show'])->name('profile');
	});

	Route::get('/produk', [ProdukController::class, 'index'])->name('produk');
	Route::get('/sign-in-static', [PageController::class, 'signin'])->name('sign-in-static');
	Route::get('/sign-up-static', [PageController::class, 'signup'])->name('sign-up-static'); 
	Route::get('/{page}', [PageController::class, 'index'])->name('page');
	Route::post('logout', [LoginController::class, 'logout'])->name('logout');
});