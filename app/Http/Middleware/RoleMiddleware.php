<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RoleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, int $role): Response
    {
        if(auth()->user()){
            if($role){
                if(auth()->user()->role_id === $role){
                    return $next($request);
                }
    
                return response()->json(['error' => 'Forbidden'], 403);
            }

            return $next($request);
        }
        /* dd(auth()->user()); */
        
        return response()->json(['error2' => 'Forbidden'], 403); 
    }
}
