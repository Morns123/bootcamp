<?php

use App\Http\Controllers\BukuController;
use App\Http\Controllers\PeminjamanController;
use App\Http\Controllers\PenulisController;
use App\Http\Controllers\PenerbitController;
use App\Http\Controllers\TransaksiBukuController;
use App\Http\Controllers\UserController;
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

Route::get('/login', [UserController::class, 'loginform'])->name('login');
Route::post('/login', [UserController::class, 'login']);
Route::get('/user', [UserController::class, 'index']);
Route::post('/tambah_akun', [UserController::class, 'store_admin']);
Route::get('/forms', [UserController::class, 'create']);

Route::get("/penerbit",[PenerbitController::class, 'index']);
Route::get("/penerbit/create",[PenerbitController::class, 'create']);
Route::get("/penerbit/hapus/{id}",[PenerbitController::class, 'delete']);
Route::post("/penerbit/store",[PenerbitController::class, 'store']);
Route::post("/penerbit/update/{id}",[PenerbitController::class, 'update']);
Route::get("/penerbit/edit/{id}",[PenerbitController::class, 'edit']);

Route::get('/penulis', [PenulisController::class, 'index']);
Route::get('/penulis/create', [PenulisController::class, 'create']);
Route::post('/penulis/store', [PenulisController::class, 'store']);
Route::get('/penulis/edit/{id}', [PenulisController::class, 'edit']);
Route::post('/penulis/update/{id}', [PenulisController::class, 'update']);
Route::get('/penulis/hapus/{id}', [PenulisController::class, 'delete']);

//buku
Route::get("/buku", [BukuController::class, 'index']);
Route::get("/buku/create", [BukuController::class, 'create']);
Route::post("/buku/create/post",[BukuController::class, 'store']);

Route::get("/transaksi/buku", [TransaksiBukuController::class, 'index']);
Route::get("/transaksi/buku/create", [TransaksiBukuController::class, 'create']);
Route::post("/transaksi/buku/create", [TransaksiBukuController::class, 'storeTransaction']);
Route::get("/transaksi/buku/{id}", [TransaksiBukuController::class, 'show']);

Route::get("/transaksi/peminjaman", [PeminjamanController::class, 'index']);
Route::get("/transaksi/peminjaman/create", [PeminjamanController::class, 'create']);
Route::post("/transaksi/peminjaman/create", [PeminjamanController::class, 'storeTransaction']);
Route::get("/transaksi/peminjaman/{id}", [PeminjamanController::class, 'show']);
