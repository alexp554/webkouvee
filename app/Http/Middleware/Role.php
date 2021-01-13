<?php

namespace App\Http\Middleware;

use App\Pegawai; 
use Closure;

class Role
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return string|null
     */
    public function handle($request, Closure $next,...$roles)
    {
         if (in_array($request->session()->get('id_role'),$roles)) {
            return $next($request); 
        }
        return redirect()->back();
    }



    // public function handle($request, Closure $next)
    // {
    //      if ($request->session()->get('id_role') != 1) {
    //         return redirect()->back();
    //     }
    //     return $next($request); 
    // }
}
