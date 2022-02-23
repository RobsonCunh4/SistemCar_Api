<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class Cors 
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return string|null
     */
   public function handle($request, Closure $next)
  {
    return $next($request)
    //Acrescente as 3 linhas abaixo
    ->header('Access-Control-Allow-Origin', "*")
    ->header('Access-Control-Allow-Methods', "PUT, POST, DELETE, GET, OPTIONS")
    ->header('Access-Control-Allow-Headers', "Accept, Authorization, Content-Type");
  }
}
