<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class EnsureProviderInfo
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
        if(auth()->user()->hasRole('loan-provider')){
            if(is_null(Auth::user()->loan_provider)){
                return redirect()->route('loan-provider-profile-create');
            }
        }

        return $next($request);
    }
}
