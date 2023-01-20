<?php

use Illuminate\Support\Facades\Route;
use App\Traits\ManagementProvider;
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

Route::get('/', [App\Http\Controllers\Home::class, 'index']);
Route::get('/sign-up', [App\Http\Controllers\Home::class, 'index']);

Route::group([
    'prefix' => 'pmb',
], function ($router) {
    Route::post('/register', [App\Http\Controllers\PendaftaranMahasiswa::class, 'register']);
});




Route::get('/logout', [App\Http\Controllers\Auth\LoginController::class, 'Logout']);
Auth::routes();

Route::group([
    'prefix' => 'auth',
], function ($router) {
    Route::get('/', [App\Http\Controllers\Auth\LoginController::class, 'index']);
    Route::post('/login', [App\Http\Controllers\Auth\LoginController::class, 'login']);
    Route::get('/logout', [App\Http\Controllers\Auth\LoginController::class, 'logout']);
});

Route::group([
    'middleware' => ['web', 'role:admin'],
    'prefix' => 'admin',
], function ($router) {
    Route::get('/', [App\Http\Controllers\admin\DashboardController::class, 'index']);
});

Route::group([
    'middleware' => ['web', 'role:mahasiswa'],
    'prefix' => 'mahasiswa',
], function ($router) {
    Route::get('/form', [App\Http\Controllers\mahasiswa\DashboardController::class, 'index']);
    Route::get('/profile', [App\Http\Controllers\mahasiswa\ProfileController::class, 'index']);
    Route::get('/upload-bukti', [App\Http\Controllers\mahasiswa\DashboardController::class, 'upload_bukti_pendaftaran']);
    Route::get('/store', [App\Http\Controllers\mahasiswa\MhsContoller::class, 'store']);
});



$namespaces = "";
foreach (ManagementProvider::RouterFormating('web', false) as $v_r) {
    if (!$v_r)
        continue;
    foreach ($v_r as $key_s => $v_source) {

        Route::group([
            'middleware' => $v_source['middleware'],
            'prefix' => $v_source['prefix'],
        ], function ($router) use ($v_source) {
            foreach ($v_source['rute'] as $x => $y) {
                if ($y['function']) {
                    Route::{$y['method']}($y['rout'], [$y['class'], $y['function']]);
                }
            }
        });
    }
}

// Route::group([
//     'prefix' => '',
// ], function ($router) {
//     Route::get('/', [App\Http\Controllers\Home::class, 'index']);
// });


// Route::group([
//     'prefix' => 'admin',
// ], function ($router) {
//     Route::get('/', [App\Http\Controllers\admin\DashboardController::class, 'index']);
// });


// Route::group([
//     'prefix' => 'admin/fakultas',
// ], function ($router) {
//     Route::get('/', [App\Http\Controllers\admin\FakultasController::class, 'index']);
//     Route::get('/store', [App\Http\Controllers\admin\FakultasController::class, 'store']);
// });

// Auth::routes();



// Auth::routes();

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
