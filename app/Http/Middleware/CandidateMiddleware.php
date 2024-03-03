<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class CandidateMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $user = Auth::user();

        if ($user && $user->account_status !== 'activated') {
            // Account is deactivated
            Auth::logout();
            return redirect()->back()->with('error', 'This Account is Deactivated! Please contact support.');
        }

        if ($user && !$user->hasRole('candidate')) {
            // User doesn't have the 'candidate' role
            Auth::logout();
            return redirect()->back()->with('error', 'You do not have permission to access this page.');
        }

        // User is activated and has the 'candidate' role, proceed with the request
        return $next($request);
        
    }
}
