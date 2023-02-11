<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\api\auth\AuthController;
use App\Service\Control\ManagementCrud;

/*
|--------------------------------------------------------------------------
| API ROUTER AUTENTICATION
*/



Route::group(['middleware' => 'api'], function ($router) {
    // Route::post('/register', [JWTController::class, 'register']);
    Route::post('/login', [AuthController::class, 'login']);
    // Route::post('/logout', [JWTController::class, 'logout']);
    Route::post('/refresh', [AuthController::class, 'refresh']);
    // Route::post('/profile', [JWTController::class, 'profile']);
    /*
    |--------------------------------------------------------------------------
    | API ROUTER MAHASISWA
    */
    Route::get('/result_main_data', [\App\Http\Controllers\Api\admin\DashboardController::class, 'dashboard_data']);
    /*
    | end router auth
    |--------------------------------------------------------------------------
    */
    // ************************************************************************
    /*
    |--------------------------------------------------------------------------
    | API ROUTER PUBLIC
    */
    Route::post('/otp_check', [\App\Http\Controllers\Auth\LoginController::class, 'otp']);
    /*
    | END API ROUTER PUBLIC
    |--------------------------------------------------------------------------
    */
    // Route::post('/register', [App\Http\Controllers\mahasiswa\PendaftaranMahasiswa::class, 'api_register']);
    Route::post('/register', [App\Http\Controllers\Api\mahasiswa\DaftarMhsController::class, 'api_register']);
    Route::post('/register_valids', [App\Http\Controllers\Api\mahasiswa\DaftarMhsController::class, 'api_register_valids']);
});

/*
| end router auth
|--------------------------------------------------------------------------
*/
// ************************************************************************
/*
|--------------------------------------------------------------------------
| API ROUTER WILAYAH
*/
Route::group([
    'middleware' => "api",
    'prefix' => 'wilayah',
], function ($router) {
    Route::get('/{id1?}/{id2?}/{id3?}/{id4?}', [
        App\Http\Controllers\WilayahController::class, 'Wilayah'
    ]);
});
/*
| END ROUTER WILAYAH
|--------------------------------------------------------------------------
*/
// ************************************************************************
/*
|--------------------------------------------------------------------------
| API ROUTER MAHASISWA
*/
Route::group([
    'middleware' => ["api", "role:mahasiswa"],
    'prefix' => 'mahasiswa',
], function ($router) {
    Route::post(
        '/register',
        [\App\Http\Controllers\Api\mahasiswa\DaftarMhsController::class, 'register']
    );
    Route::post(
        '/register-prodi-update',
        [\App\Http\Controllers\Api\mahasiswa\DaftarMhsController::class, 'update_prodi']
    );
    Route::get(
        '/get-prodi-id/{slug?}',
        [\App\Http\Controllers\Api\mahasiswa\DaftarMhsController::class, 'getById']
    );
    Route::get(
        '/getAgent',
        [\App\Http\Controllers\Api\mahasiswa\DaftarMhsController::class, 'getAgent']
    );
    Route::post(
        '/addReferal',
        [\App\Http\Controllers\Api\mahasiswa\DaftarMhsController::class, 'addReferal']
    );

    Route::post(
        '/upload-bukti-biaya-pendaftaran',
        [\App\Http\Controllers\Api\mahasiswa\DaftarMhsController::class, 'upload_bukti_biaya_pendaftaran']
    );
    Route::post(
        '/upload-lampiran',
        [\App\Http\Controllers\Api\mahasiswa\DaftarMhsController::class, 'upload_lampiran']
    );
    Route::get(
        '/read',
        [\App\Http\Controllers\Api\mahasiswa\DaftarMhsController::class, 'read']
    );
});
/*
| END ROUTER MAHASISWA
|--------------------------------------------------------------------------
*/
// ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
/*
|--------------------------------------------------------------------------
| API ROUTER MAHASISWA ROLE ADMIN
*/
Route::group([
    'middleware' => ["api", "role:admin"],
    'prefix' => 'mhs',
], function ($router) {
    Route::post(
        '/verifikasi_pendaftaran/{slug}',
        [\App\Http\Controllers\Api\admin\MahasiswaController::class, 'verifikasi_pendaftaran']
    );
    Route::post(
        '/status_seleksi/{slug}',
        [\App\Http\Controllers\Api\admin\MahasiswaController::class, 'status_seleksi']
    );
});

/*
| END ROUTER MAHASISWA
|--------------------------------------------------------------------------
*/

// ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
/*
|--------------------------------------------------------------------------
| API PUBLIC
*/
Route::group([
    'prefix' => 'public',
], function ($router) {
    Route::get(
        '/report-mhs',
        [\App\Http\Controllers\Api\PublicApi\DataPublicController::class, 'getReportCMhs']
    );
});
/*
| END PUBLIC
|--------------------------------------------------------------------------
*/
// ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
/*
|--------------------------------------------------------------------------
| API AGENT
*/
Route::group([
    'prefix' => 'agent',
], function ($router) {
    Route::post(
        '/pencairan',
        [\App\Http\Controllers\Api\admin\AgentController::class, 'api_pencairan']
    );
});
/*
| END PUBLIC
|--------------------------------------------------------------------------
*/
