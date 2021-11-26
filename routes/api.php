<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\BoardingHouseController;
use App\Http\Controllers\API\FasilitasController;
use App\Http\Controllers\API\FotoKamarController;
use App\Http\Controllers\API\FotoKosController;
use App\Http\Controllers\API\JenisController;
use App\Http\Controllers\API\KelasController;
use App\Http\Controllers\API\PengelolaController;
use App\Http\Controllers\API\UserController;
use App\Models\Jenis;

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

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::post('register', [UserController::class, 'register']);
Route::post('login', [UserController::class, 'login']);

Route::middleware('auth:sanctum')->group(function () {
    Route::get('user', [UserController::class, 'fetch']);
    Route::post('user', [UserController::class, 'updateProfile']);
    Route::post('logout', [UserController::class, 'logout']);
});
Route::get('transaction', [TransactionController::class, 'all']);

Route::get('kost', [BoardingHouseController::class, 'all']);
Route::post('kost', [BoardingHouseController::class, 'addHouse']);

Route::get('fasilitas', [FasilitasController::class, 'all']);
Route::post('fasilitas', [FasilitasController::class, 'addFasilitas']);

Route::get('fotokamar', [FotoKamarController::class, 'all']);
Route::post('fotokamar', [FotoKamarController::class, 'addFotoKamar']);

Route::get('fotokos', [FotoKosController::class, 'all']);
Route::post('fotokos', [FotoKosController::class, 'addFotoKos']);

Route::get('jenis', [JenisController::class, 'all']);
Route::post('jenis', [JenisController::class, 'addJenis']);

Route::get('kelas', [KelasController::class, 'all']);
Route::post('kelas', [KelasController::class, 'addKelas']);

Route::get('pengelola', [PengelolaController::class, 'all']);
Route::post('pengelola', [PengelolaController::class, 'addPengelola']);