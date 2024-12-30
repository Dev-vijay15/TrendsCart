<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Spatie\Permission\Models\Role;

class userAuthController extends Controller
{
    public function showLoginForm()
    {
        return view('frontend.auth.login');
    }

    public function login(Request $request)
    {
        // Validate the login input
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:6',
        ]);

        // Attempt to log in the user
        if (Auth::attempt(['email' => $request->email, 'password' => $request->password,], $request->remember)) {

            if (Auth::check() && Auth::user()->role == 3) {
                // Redirect to the dashboard if successful
                return redirect()->route('frontend.index');
            } else {

                Auth::logout();
                return redirect()->route('users.login')->withErrors('You are not Authorized to access this page');
            }
        }

        // If authentication fails, redirect back with an error
        return back()->withErrors([
            'email' => 'These credentials do not match our records.',
        ]);
    }


    public function showRegisterForm()
    {
        return view('backend.auth.register');
    }

    public function register(Request $request)
    {
        // Validate request
        $validator = Validator::make($request->all(), [
            'first_name' => 'required|string|min:3',
            'last_name' => 'required|string|min:3',
            'email' => 'required|email|unique:users,email',
            'mobile' => 'required|numeric|digits:10',
            'password' => 'required|min:6|confirmed',
        ]);

        // If validation fails, redirect back with errors
        if ($validator->fails()) {
            return redirect()
                ->back()
                ->withErrors($validator)
                ->withInput();  // Keep old input data
        }

        // Create new user
        $user = new User();
        $user->first_name = $request->first_name;
        $user->last_name = $request->last_name;
        $user->email = $request->email;
        $user->mobile = $request->mobile;
        $user->password = Hash::make($request->password);
        $user->save();

        // Fetch the last inserted user ID (this will be the current user's ID)
        $userId = $user->id;

        // Assign default role (3 = Customer)
        $role = Role::find(3);  // Ensure role 3 exists in your roles table
        if ($role) {
            $user->syncRoles([$role->id]);  // Assign the role to the user
            $user->role = $role->id;
            $user->save();
        } else {
            return back()->with('error', 'Role not found.');
        }

        // Redirect after successful registration
        return redirect()->route('frontend.index')->with('success', 'Registration successful!');
    }


    public function logout()
    {
        // Secure and clean logout process
        Auth::logout();                     // Logs out the user
        session()->invalidate();            // Clears all session data
        session()->regenerateToken();       // Regenerates the CSRF token
        

        return redirect()->route('users.login');
    }
}
