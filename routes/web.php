<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\BeritaController;
use App\Http\Controllers\GalleryController;
use App\Http\Controllers\GambarController;
use App\Http\Controllers\KontakController;
use App\Http\Controllers\TentangController;
use App\Models\Berita;
use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return view('welcome');
// });

//Admin
Route::get('/admin', [AdminController::class, 'index'])->name('admin.dashboard');
Route::get('/login', [AdminController::class, 'login'])->name('admin.login');
Route::post('/login', [AdminController::class, 'loginPost'])->name('admin.login.post');
Route::get('/logout', [AdminController::class, 'logout'])->name('logout');

//Berita
Route::get('/adber',[AdminController::class, 'berita'])->name('admin.berita');
Route::post('/berstore',[BeritaController::class, 'store'])->name('admin-berita-store');
Route::put('/berupdate/{id}',[BeritaController::class, 'update'])->name('admin-berita-update');
Route::delete('/berdele/{id}',[BeritaController::class, 'delete'])->name('admin-berita-delete');

//Tentang
Route::get('/adtentang',[AdminController::class,'tentang'])->name('admin.tentang');
Route::post('/tentangstore',[TentangController::class,'store'])->name('admin.tentang-store');
Route::put('/tentangupdate/{id}',[TentangController::class,'update'])->name('admin.tentang-update');
Route::delete('/tentangdele/{id}',[TentangController::class,'delete'])->name('admin.tentang-delete');

//Gallery
Route::get('/adgallery',[AdminController::class,'gallery'])->name('admin.gallery');
Route::post('/gallstore',[GalleryController::class,'gallstore'])->name('admin.gallery-store');
Route::put('/gallupdate/{id}',[GalleryController::class,'gallupdate'])->name('admin.gallery-update');
Route::delete('/galldele/{id}',[GalleryController::class,'galldelete'])->name('admin.gallery-delete');

//Gambar
Route::get('/adgambar',[AdminController::class,'gambar'])->name('admin.gambar');
Route::post('/gambstore',[GambarController::class,'store'])->name('admin.gambar-store');
Route::put('/gambupdate/{id}',[GambarController::class,'update'])->name('admin.gambar-update');
Route::delete('/gambdele/{id}',[GambarController::class,'delete'])->name('admin.gambar-delete');

//Ulasan
Route::get('/adulas',[AdminController::class,'ulas'])->name('admin.ulasan');
Route::post('/ulasstore',[AdminController::class,'ulasstore'])->name('admin-ulas-store');
Route::put('/ulasupdate/{id}',[AdminController::class,'ulasupdate'])->name('admin-ulas-update');
Route::delete('/ulasdele/{id}',[AdminController::class,'ulasdelete'])->name('admin-ulas-delete');

//Kontak
Route::get('/adkontak',[AdminController::class,'kontak'])->name('admin.kontak');
Route::post('/kontakstore',[KontakController::class,'store'])->name('admin-kontak-store');
Route::put('/kontakupdate/{id}',[KontakController::class,'update'])->name('admin-kontak-update');
Route::delete('/kontakdelete/{id}',[KontakController::class,'delete'])->name('admin-kontak-delete');
