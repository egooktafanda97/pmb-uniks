<?php

namespace App\Http\Middleware;


use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Session;

class Authenticate extends Middleware
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return string|null
     */
    protected function redirectTo($request)
    {
        // if (!$request->expectsJson()) {
        //     abort(response()->json(['error' => 'You don\'t have access', 'response' => 'Unauthorized', "auth" => false], 403));
        // }

        if (!$request->expectsJson()) {
            return route('login');
        }
    }
}
