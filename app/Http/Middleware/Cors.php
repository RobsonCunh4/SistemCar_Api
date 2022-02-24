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
   public function handle(Request $request , Closure $next)
  {
    return $next($request)
    ->header("Access-Control-Allow-Origin", "*")
    ->header("Access-Control-Allow-Credentials", "true")
    ->header("Access-Control-Allow-Methods", "GET, POST, PUT, DELETE, OPTIONS")
    ->header("Access-Control-Allow-Headers", "X-Requested-With, Content-Type, X-Token-Auth, Authorization");
  }
}
