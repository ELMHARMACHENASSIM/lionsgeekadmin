<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class AdminMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        if (auth()->user() && auth()->user()->hasRole('admin')) {
            return $next($request);
        }

        // If the user is not an admin, you can redirect them or return an error response.
        // Example 1: Redirect to the home page
        // return redirect('/');

        // Example 2: Return a forbidden response
        return abort(403, 'Access Denied');
    }
}
