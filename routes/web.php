<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\VideoController;
use App\Http\Controllers\GiziController;
use App\Http\Controllers\ResepController;
use App\Http\Controllers\KalkulatorController;

/*
|--------------------------------------------------------------------------
| Web Routes - GiziSehat
|--------------------------------------------------------------------------
*/

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::get('/video-edukasi', [VideoController::class, 'index'])->name('video.index');
Route::get('/video-edukasi/filter', [VideoController::class, 'filter'])->name('video.filter');

Route::get('/menu-gizi', [GiziController::class, 'index'])->name('gizi.index');

Route::get('/resep', [ResepController::class, 'index'])->name('resep.index');

Route::get('/kalkulator', [KalkulatorController::class, 'index'])->name('kalkulator.index');
Route::post('/kalkulator/hitung', [KalkulatorController::class, 'hitung'])->name('kalkulator.hitung');