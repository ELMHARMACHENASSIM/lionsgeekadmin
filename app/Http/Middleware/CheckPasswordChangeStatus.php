<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;
use Symfony\Component\HttpFoundation\Response;

class CheckPasswordChangeStatus
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    // public function handle(Request $request, Closure $next): Response
    // {
    //     return $next($request);
    // }
    // app/Http/Middleware/CheckPasswordChangeStatus.php

// public function handle($request, Closure $next)
// {
//     // Check if the authenticated user's requires_password_change is true
//     if (Auth::check() && Auth::user()->password_changed === false) {
//         return redirect()->route('password.change'); // Redirect to the password change page
//     }

//     return $next($request);
// }
// app/Http/Middleware/CheckPasswordChangeStatus.php

public function handle($request, Closure $next)
{
    // Check if the authenticated user's password_changed property is false
    if (auth()->check() && !auth()->user()->password_changed) {
        // Generate a new password reset token for the user
        $user = auth()->user();
        $token = Password::createToken($user);

        // Generate the URL for the password reset page with the generated token
        $resetUrl = route("change.password", ['token' => $token]);

        return redirect($resetUrl); // Redirect to the password reset page with the token
    }

    return $next($request);
}



}
