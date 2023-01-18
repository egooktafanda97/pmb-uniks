<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Session;

class AuthCheckWebApi
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        // auth("api")->setToken(Session::get('token')['access_token']);
        // dd(auth("api")->check());
        // if (!auth("api")->check())
        //     return redirect('login');
        // auth("api")->setToken(Session::get('token')['access_token']);
        // if (!$token = $this->respondWithToken(auth("api")->refresh()))
        //     return redirect('login');
        // Session::put('token',  $this->respondWithToken(auth("api")->refresh()));

        return $next($request);
    }
}
