<?php

namespace App\Http\Controllers;

use App\Models\Classe;
use App\Models\ReservationClasse;
use App\Models\ReservationStudio;
use App\Models\Role;
use App\Models\Studio;
use App\Models\User;
use App\Models\UserRole;
use App\Notifications\PasswordChangedNotification;
use App\Notifications\PasswordEmailNotification;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;


class AdminController extends Controller
{
    public function index()
    {
        $startDay = Carbon::now()->startOfDay();
        $endDay = Carbon::now()->endOfDay();

        $studioToday = ReservationStudio::whereBetween("start_time", [$startDay, $endDay])
            ->whereBetween("finish_time", [$startDay, $endDay])
            ->get();

        $classToday = ReservationClasse::whereBetween("start_time", [$startDay, $endDay])
            ->whereBetween("finish_time", [$startDay, $endDay])
            ->get();

        $combinedReservations = $classToday->concat($studioToday);
        $combinedReservations = $combinedReservations->sortBy('start_time');
        
        return view("Backend.pages.admindashpage", compact("combinedReservations"));
    }

    public function members()
    {
        $users = User::all();
        $recordCount = User::count();
        return view("Backend.pages.members", compact("users", "recordCount"));
    }

    public function adduser()
    {
        return view("Backend.pages.adduser");
    }

    public function updateClassIndex(Classe $classe)
    {
        return view("Backend.pages.updateclass", compact("classe"));
    }

    public function showClassIndex()
    {
        $classes = Classe::all();
        return view("Backend.pages.classshow", compact("classes"));
    }

    public function updateStudioIndex(Studio $studio)
    {
        $studios = Studio::all();
        return view("Backend.pages.updatestudio", compact("studios", "studio"));
    }

    public function adminDashPage()
    {
        $startDay = Carbon::now()->startOfDay();
        $endDay = Carbon::now()->endOfDay();

        $studioToday = ReservationStudio::whereBetween("start_time", [$startDay, $endDay])
            ->whereBetween("finish_time", [$startDay, $endDay])
            ->get();

        $classToday = ReservationClasse::whereBetween("start_time", [$startDay, $endDay])
            ->whereBetween("finish_time", [$startDay, $endDay])
            ->get();

        $combinedReservations = $classToday->concat($studioToday);
        $combinedReservations = $combinedReservations->sortBy('start_time');
        return view("Backend.pages.admindashpage", compact("combinedReservations"));
    }

    public function historiqueIndex()
    {
        $classReservation = ReservationClasse::all();
        $studioReservation = ReservationStudio::all();
        $combinedReservations = $classReservation->concat($studioReservation);
        $combinedReservations = $combinedReservations->sortByDesc('start_time');

        return view("Backend.pages.historique", compact("combinedReservations"));
    }

    public function create(Request $request)
    {
        // Validate the incoming request data
        $request->validate([
            'name' => 'required',
            'email' => 'required|unique:users,email', // Ensure email uniqueness
            'img' => 'image|mimes:png,jpg,svg,jpeg,jfif|max:2048', // Adjust the max file size as needed
            'user_type' => 'required|in:interne,externe', // Ensure the user_type is one of the specified values
            'roles' => 'array', // Ensure roles is an array
        ]);

        // Generate a random password
        $randomPassword = Str::random(12);

        // Create the user with user type and password
        $userType = ($request->input('user_type') === 'externe') ? 1 : 2;

        $user = User::create([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'img' => $this->storeProfileImage($request->file('img')),
            'password' => Hash::make($randomPassword),
            'usertype_id' => $userType,
        ]);

        $selectedRoles = request('roles', []); // This should be an array of selected role names

        // If no roles are selected, assign the default "user" role
        if (empty($selectedRoles)) {
            $selectedRoles = ['user'];
        }

        // Fetch the role models based on their names
        $roles = Role::whereIn('name', $selectedRoles)->get();

        // Extract the role IDs from the role models
        $roleIds = $roles->pluck('id')->toArray();

        // Attach the selected roles to the user using role IDs
        $user->roles()->attach($roleIds);

        // Create pivot records for each selected role
        foreach ($roleIds as $roleId) {
            UserRole::create([
                'user_id' => $user->id,
                'role_id' => $roleId,
            ]);
        }


        // Send the email with the generated password
        $user->notify(new PasswordEmailNotification($randomPassword));

        // Redirect the user after registration
        return redirect()->route("admin.members")->with('success', 'Inscription réussie. Vérifiez votre courrier électronique pour le mot de passe.');
    }

    /**
     * Store the user's profile image and return the file name.
     *
     * @param  \Illuminate\Http\UploadedFile  $image
     * @return string|null
     */
    private function storeProfileImage($image)
    {
        if ($image) {
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->storeAs('img/profile/', $imageName, 'public');
            return $imageName;
        }
        return null;
    }
    public function update(Request $request, User $user)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'password' => 'nullable|string|min:8',
        ]);

        // Update user's basic information
        $user->update([
            'name' => $request->filled('name') ? $request->input('name') : $user->name,
            'email' => $request->input('email'),
            'usertype_id' => ($request->input('user_type') === 'externe') ? 1 : 2,
        ]);

        // Update the user's password if provided
        if ($request->filled('password')) {
            // Update the user's password
            $user->update([
                'password' => Hash::make($request->input('password')),
            ]);

            $newPassword = $request->input('password');

            // Send the password change notification
            $user->notify(new PasswordChangedNotification($newPassword));
        }

        // Sync the user's roles
        $selectedRoles = $request->input('roles', []);

        // If the user has the 'admin' role, ensure that both 'gestionnaire_classe' and 'gestionnaire_studio' are selected
        if ($user->hasRole('admin')) {
            $selectedRoles = ['gestionnaire_classe', 'gestionnaire_studio'];
        }

        // Get the role models based on role names
        $roles = Role::whereIn('name', $selectedRoles)->get();

        // Extract the role IDs from the role models
        $roleIds = $roles->pluck('id')->toArray();
        // // Attach the selected roles to the user using role IDs
        $user->roles()->sync($roleIds);

        // // Check if no roles were selected
        // if (count($selectedRoles) === 0) {
        //     $user->assignRole('user');
        // }


        // Redirect back with a success message
        return redirect()->back()->with('success', 'User information updated successfully.');
    }

    public function destroy(User $user)
    {
        // Remove user's roles and permissions
        $user->roles()->detach();

        // Delete the user
        $user->delete();

        // Optionally, you can add a success message or response here
        return redirect()->route('admin.members')->with('success', 'User deleted successfully');
    }
}
