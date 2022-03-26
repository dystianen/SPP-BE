<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\KelasController;
use App\Http\Controllers\PembayaranController;
use App\Http\Controllers\SiswaController;
use App\Http\Controllers\SppController;
use App\Http\Controllers\PetugasController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\LoginSiswa;
use App\Http\Controllers\TransaksiController;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
Route::get('/dapatkankelas',[KelasController::class,'getkelas']);
Route::get('/carisiswa/{nisn}',[SiswaController::class,'cari_siswa']);
Route::get('/yokkelas/{id_kelas}',[KelasController::class,'cari_kelas']);
Route::get('/getkelass',[KelasController::class,'indexkelas']);
Route::post('/register', [UserController::class,'register']); //register untuk petugas dan admin
Route::post('login', [UserController::class,'login']); //login untuk petugas dan admin
Route::post('register_siswa', [LoginSiswa::class,'registersiswa']); //register siswa
Route::post('login_siswa', [LoginSiswa::class,'login']); //login untuk siswa
Route::get('/getpetugas',[PetugasController::class,'getpetugas']);

//pembagian hak akses petugas
Route::group(['middleware'=>['jwt.verify:petugas']],function(){
    Route::post('/pembayaranpetugas',[TransaksiController::class,'Transaksi']);
	Route::get('/kurang_bayar/{id}',[TransaksiController::class,'kurang_bayar']);
});
//pembagian hak akses admin
Route::group(['middleware'=>['jwt.verify:admin']],function(){
    Route::post('/inputkelas',[KelasController::class,'inputkelas']);
    Route::put('/updatekelas/{id_kelas}',[KelasController::class,'updatekelas']);
    Route::delete('/deletekelas/{id_kelas}',[KelasController::class,'deletekelas']);
    Route::put('/updatesiswa/{nisn}',[SiswaController::class,'updatesiswa']);
    Route::delete('deletesiswa/{nisn}',[SiswaController::class,'deletesiswa']);
    Route::post('/inputpetugas',[PetugasController::class,'inputpetugas']);
    Route::put('/updatepetugas/{id_petugas}',[PetugasController::class,'updatepetugas']);
    Route::delete('/deletepetugas/{id_petugas}',[PetugasController::class,'hapuspetugas']);
    Route::post('/inputspp',[SppController::class,'inputspp']);
    Route::get('/getspp',[SppController::class,'getspp']);
    Route::put('/updatespp/{id_spp}',[SppController::class,'updatespp']);
    Route::delete('/deletespp/{id_spp}',[SppController::class,'deletespp']);
    Route::post('inputpembayaran/',[PembayaranController::class,'inputpembayaran']);
    Route::get('/getpembayaran',[PembayaranController::class,'getpembayaran']);
    Route::put('/updatepembayaran/{id_pembayaran}',[PembayaranController::class,'updatepembayaran']);
    Route::delete('/hapuspembayaran/{id_pembayaran}',[PembayaranController::class,'hapuspembayaran']);
    Route::post('/pembayaran',[TransaksiController::class,'Transaksi']);
	Route::get('/kurang_bayar/{id}',[TransaksiController::class,'kurang_bayar']);

});
//pembagian hak akses siswa
Route::group(['middleware'=>['jwt.verify:siswa']],function(){
    Route::get('/getsiswa',[SiswaController::class,'indexsiswa']);
    Route::get('/lihatkelas',[KelasController::class,'getkelas']);
    Route::get('/kurang_bayar/{id}',[TransaksiController::class,'kurang_bayar']);

});
Route::post('/inputsiswa',[SiswaController::class,'inputsiswa']);
