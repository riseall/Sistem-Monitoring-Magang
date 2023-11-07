<?php

use App\Http\Controllers\Api\AbsenKeluarController;
use App\Http\Controllers\Api\AbsenMasukController;
use App\Http\Controllers\Api\PegawaiController;
use App\Http\Controllers\Api\MahasiswaController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::apiResource('pegawai', PegawaiController::class);

Route::apiResource('mahasiswa', MahasiswaController::class);

Route::apiResource('absenMasuk', AbsenMasukController::class);
Route::apiResource('absenKeluar', AbsenKeluarController::class);