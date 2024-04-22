<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckSession
{
    
    public function handle(Request $request, Closure $next): Response
    {

        // Check if the user is logged in
        if(!session()->has('user')) {
            return redirect()->route('home');
        }

        return $next($request);
    }
}
