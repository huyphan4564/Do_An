<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Symfony\Component\HttpFoundation\Response;

class Locale
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $locale = "vi";
        if (Session::exists('locale')){
            $locale = Session::get('locale');
        }
        App::setLocale($locale);
        switch ($locale){
            case 'en':
                config(['database.default' => 'mysql_en']);
                DB::reconnect('mysql_en');
                break;
            default:
                config(['database.default' => 'mysql']);
                DB::reconnect('mysql');
        }
        return $next($request);
    }
}
