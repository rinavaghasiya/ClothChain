<?php

namespace App\Http\Middleware;

use Closure;
use Session;

class main
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
       if(Session::has('user_id1'))
        {
            return $next($request);
        }
        else
        {
            return redirect('main');
        }
    }
}
