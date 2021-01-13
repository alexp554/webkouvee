<?php

namespace App\Http\Middleware;

use App\Pegawai; 
use Closure;

class CheckUser 
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return string|null
     */
    public function handle($request, Closure $next)
    {
         if (!$request->session()->exists('nama_pegawai')) {
            return redirect('/login');
        }
        return $next($request); 
    }
}
