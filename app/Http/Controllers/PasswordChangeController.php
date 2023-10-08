<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class PasswordChangeController extends Controller
{
    //

    public function show()
    {
        return view("auth.password-change");
    }



    // app/Http/Controllers/PasswordController.php

    public function change(Request $request)
    {

        // Get the authenticated user
        $user = auth()->user();

        // Retrieve the hashed password from the database
        $hashedPasswordFromDatabase = $user->password;

        // Check if the provided current password matches the hashed password from the database
        if (Hash::check($request->current_password, $hashedPasswordFromDatabase)) {
            if ($request->new_password) {
                if ($request->new_password == $request->confirm_new_password) {
                    $hashedPassword = Hash::make($request->input('new_password'));
                    $user->update([
                        'password' => $hashedPassword,
                        'password_changed' => true,
                    ]);
                    return redirect()->route("user.reservation")->with('success', 'Password changed successfully.');
                } else {
                    return redirect()->back()->with('error', 'Unmatched passwords.');
                }
            }
        } else {
            return redirect()->back()->with('error', 'Current password is incorrect.');
        }


    }
}
