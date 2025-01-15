<?php
use App\Http\Controllers\ChatController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\MahasiswaController;
use App\Http\Controllers\JadwalController;
use App\Http\Controllers\PembayaranController;
use App\Http\Controllers\ArtikelController;
use App\Http\Controllers\ProgramStudiController;
use App\Http\Controllers\OrganisasiController;
use App\Http\Controllers\PrestasiController;
use App\Http\Controllers\VideoController;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


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
Route::post('/login', [LoginController::class, 'login']);
Route::post('/logout', [LoginController::class, 'logout'])->middleware('auth:api');
Route::post('/daftar', [MahasiswaController::class, 'store']);
Route::post('/send-message', [ChatController::class, 'messageUser']);
Route::get('/get-messages/{pengirim}', [ChatController::class, 'getMessages']);
Route::post('/buat-chat', [ChatController::class, 'mulaiChat']);
Route::get('/artikel', [ArtikelController::class, 'index']);
Route::post('/artikel', [ArtikelController::class, 'store']);
Route::get('/artikel/{id}', [ArtikelController::class, 'show']);
Route::post('/artikel/{id}', [ArtikelController::class, 'update']);
Route::delete('/artikel/{id}', [ArtikelController::class, 'destroy']);
Route::get('/programstudi', [ProgramStudiController::class, 'index']);
Route::get('/organisasi', [OrganisasiController::class, 'index']);
Route::get('/prestasi', [PrestasiController::class, 'index']);
Route::get('/video', [VideoController::class, 'index']);
Route::get('/jadwal', [JadwalController::class, 'index']);
Route::post('/jadwal', [JadwalController::class, 'store']);
Route::get('/jadwal/{id}', [JadwalController::class, 'show']);
Route::put('/jadwal/{id}', [JadwalController::class, 'update']);
Route::delete('/jadwal/{id}', [JadwalController::class, 'destroy']);
Route::middleware(['auth:api', 'role:admin'])->group(function () {
    Route::get('/me', [loginController::class, 'me']);

    Route::get('/chatAdmin', [ChatController::class, 'getChatsByStatus']);
    Route::post('/send-admin', [ChatController::class, 'messageAdmin']);
    Route::put('/chats/{id}/approve', [ChatController::class, 'approveChat']);
    Route::put('/chats/{id}/end', [ChatController::class, 'endChat']);


    Route::get('/adminvideo', [VideoController::class, 'index']);
    Route::post('/adminvideo', [VideoController::class, 'store']);
    Route::get('/adminvideo/{id}', [VideoController::class, 'show']);
    Route::post('/adminvideo/{id}', [VideoController::class, 'update']);
    Route::delete('/adminvideo/{id}', [VideoController::class, 'destroy']);
    
    Route::get('/mahasiswa', [MahasiswaController::class, 'index']);
    Route::get('/pendaftar', [MahasiswaController::class, 'index']);
    Route::get('/pembayaran', [MahasiswaController::class, 'index']);
    Route::put('/mahasiswa/{id}/konfirmasi', [MahasiswaController::class, 'konfirmasiPembayaran']);



});
Route::middleware(['auth:api', 'role:mahasiswa'])->group(function () {
    Route::get('/mahasiswa/me', [MahasiswaController::class, 'showAuthenticatedMahasiswa']);
    Route::get('/mahasiswa/pembayaran/me', [MahasiswaController::class, 'showAuthenticatedMahasiswaPembayaran']);
    Route::get('/jadwal/{id}', [JadwalController::class, 'show']);
});