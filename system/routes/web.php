<?php

use App\Helpers\Helpers;
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
// testing template email
// Route::get('/email-test', function () {
//     $data = [
//         "email" => "egooktafanda1097@gmail.com",
//         "nama" => "ego oktafanda",
//         "kode" => Helpers::generatePin(4)
//     ];
//     return view('emails.verify', $data);
// });

// testing template email




Route::get('/', [App\Http\Controllers\Home::class, 'index']);
Route::get('/sign-up', [App\Http\Controllers\Home::class, 'index']);
Route::get('/programstudi/', [App\Http\Controllers\Home::class, 'prodi']);
Route::get('/info_pendaftaran', [App\Http\Controllers\Home::class, 'info_pendaftaran']);



Route::group([
    'prefix' => 'pmb',
], function ($router) {
    Route::post('/register', [App\Http\Controllers\mahasiswa\PendaftaranMahasiswa::class, 'register']);
});



Auth::routes();
Route::get('/auth/verifikasi', [App\Http\Controllers\mahasiswa\PendaftaranMahasiswa::class, 'verifikasi']);
Route::get('/auth/redirect', [App\Http\Controllers\Auth\LoginController::class, 'redirectToProvider']);
Route::get('/auth/callback', [App\Http\Controllers\Auth\LoginController::class, 'handleProviderCallback']);
// Route::get('/logout', [App\Http\Controllers\Auth\LoginController::class, 'Logout']);


Route::group([
    'prefix' => 'auth',
], function ($router) {
    Route::get('/', [App\Http\Controllers\Auth\LoginController::class, 'index']);
    Route::post('/login', [App\Http\Controllers\Auth\LoginController::class, 'login']);
    Route::get('/logout', [App\Http\Controllers\Auth\LoginController::class, 'logout']);
    Route::get('/verify/{slug?}', [App\Http\Controllers\Auth\LoginController::class, 'verify']);
    Route::post('/resending_email', [App\Http\Controllers\Auth\LoginController::class, 'resending_email']);
    Route::get('/reset_password', [App\Http\Controllers\Auth\LoginController::class, 'reset_password']);
    Route::post('/email_check', [App\Http\Controllers\Auth\LoginController::class, 'email_check']);
    Route::get('/reset', [App\Http\Controllers\Auth\LoginController::class, 'resets']);
    Route::post('/reset_confirm', [App\Http\Controllers\Auth\LoginController::class, 'reset_confirm']);
});

Route::group([
    'middleware' => ['web', 'role:admin'],
    'prefix' => 'admin',
], function ($router) {
    Route::get('/', [App\Http\Controllers\admin\DashboardController::class, 'index']);
});

Route::group([
    'middleware' => ['web', 'role:admin'],
    'prefix' => 'report',
], function ($router) {
    Route::post('/report_cmhs', [App\Http\Controllers\admin\ReportController::class, 'report_cmhs']);
    Route::get('/report_excel', [App\Http\Controllers\admin\ReportController::class, 'report_excel']);
    Route::get('/id-card', [App\Http\Controllers\admin\ReportController::class, 'IdCard']);
});
Route::group([
    'middleware' => ['web', 'role:mahasiswa'],
    'prefix' => 'report',
], function ($router) {
    Route::get('/id-card', [App\Http\Controllers\admin\ReportController::class, 'IdCard']);
});


Route::group([
    'middleware' => ['web', 'role:mahasiswa'],
    'prefix' => 'mahasiswa',
], function ($router) {
    Route::get('/form', [App\Http\Controllers\mahasiswa\DashboardController::class, 'index']);
    Route::get('/profile', [App\Http\Controllers\mahasiswa\ProfileController::class, 'index']);
    Route::get('/upload-bukti', [App\Http\Controllers\mahasiswa\DashboardController::class, 'upload_bukti_pendaftaran']);
    Route::get('/store', [App\Http\Controllers\mahasiswa\MhsContoller::class, 'store']);
    Route::get('/faq', [App\Http\Controllers\mahasiswa\MhsContoller::class, 'faq']);
});

Route::get('send-email-queue', function () {
    return view('emails.SendEmail');
    // $details['email'] = 'egookt3010@gmail.com';
    // dispatch(new App\Jobs\SendEmailJob($details));
    // return response()->json(['message' => 'Mail Send Successfully!!']);
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
