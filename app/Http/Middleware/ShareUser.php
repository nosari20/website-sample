<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class ShareUser
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
        //Creating access data
        $data = new \stdClass();        
        $data->{'user'} = Auth::user();   
        view()->share((array)$data);  
        return $next($request);
    }
}
