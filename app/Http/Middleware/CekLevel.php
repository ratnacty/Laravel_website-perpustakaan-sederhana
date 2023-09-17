<?php

namespace App\Http\Middleware;

use auth;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CekLevel
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next,...$levels): Response
    {
        if( in_array(auth()->user()->level,$levels)){
            return $next($request);
        }

        return redirect()->route('/home')->with(['errors' => 'Anda tidak diperbolehkan akses halaman selain halaman yang tersedia di menu']);
         
    }
}
