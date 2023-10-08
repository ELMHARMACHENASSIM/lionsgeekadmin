<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class GestionStudioMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (auth()->user() && auth()->user()->hasRole('gestionnaire_studio')) {
            return $next($request);
        }

        // If the user is not an admin, you can redirect them or return an error response.
        // Example 1: Redirect to the home page
        // return redirect('/');

        // Example 2: Return a forbidden response
        return abort(403, 'Access Denied');
    }

    }

