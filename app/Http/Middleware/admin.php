<?php

namespace App\Http\Middleware;

use Closure;
use Session;

class admin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
         if(Session::has('admin_id'))
        {
            return $next($request);
        }
        else
        {
            return redirect('adminlogin');
        }
    }
}
