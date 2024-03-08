<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpFoundation\Response;

class verifyToken
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if(session('token')){
            // dd(session('token'));
            $response = Http::withHeaders([
                'Authorization' => 'Bearer ' . session('token'),
            ])->get('http://localhost:8001/api/token/check-expiry');

            if ($response && is_array($response->json())) {
                $message = $response->json()['message'];
    
                if ($message === 'Token is valid.') {
                    return $next($request);
                } else {
                    throw ValidationException::withMessages([
                        'error' => ['Somthing went wrong with token verification']
                    ]);
                }
            } else {
                return redirect()->route('auth.logout')->with('error','Your session is expired please login again');
            }
        }
        return $next($request);
    }
}
