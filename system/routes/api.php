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
});

/*
| end router auth
|--------------------------------------------------------------------------
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
|--------------------------------------------------------------------------
| API ROUTER GENERATOR BY FILE JSON
*/
// require("Registry.php");
// foreach ($RouterFormat as $v_r) {
//     foreach ($v_r as $key_s => $v_source) {
//         Route::group([
//             'middleware' => $v_source['middleware'], //$v_source['middleware']
//             'prefix' => $v_source['prefix'],
//         ], function ($router) use ($v_source) {
//             foreach ($v_source['rute'] as $x => $y) {
//                 Route::{$y['method']}($y['rout'], [$y['class'], $y['function']]);
//             }
//         });
//     }
// }
/*
| end router auth
|--------------------------------------------------------------------------
*/
