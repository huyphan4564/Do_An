<?php

namespace App\Http\Middleware;

use App\StaticString;
use Closure;
use Illuminate\Http\Request;

class isLogin
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
        if ($request->session()->get(StaticString::SESSION_IDTK)) {
            return $next($request);
        } else {
            $request->session()->put(StaticString::SESSION_URL_BF_LOGIN,  $request->fullUrl());
            return redirect()->action('App\Http\Controllers\TaiKhoanController@getViewDangNhap');
        }
    }
}
