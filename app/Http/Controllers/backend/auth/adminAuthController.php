<?php

namespace App\Http\Controllers\backend\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Spatie\Permission\Models\Role;

class adminAuthController extends Controller
{
    //

    public function LoginForm()
    {
        
        return view('backend.auth.login');
    }

    public function adminLogin(Request $request)
    {

        // Validate the login input
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required|min:6',
        ]);


        if ($validator->passes()) {

            // Attempt to log in the user
            if (Auth::guard('admin')->attempt(['email' => $request->email, 'password' => $request->password], $request->remember)) {


                if (Auth::guard('admin')->check()) {

                    if ((Auth::guard('admin')->user()->role == 1) || (Auth::guard('admin')->user()->role == 2)) {

                        session()->flash('success', 'You have logged in successfully.!');

                        return redirect()->route('admin.dashboard');              // Redirect to the dashboard if successful

                    } else {

                        Auth::guard('admin')->logout();

                        return redirect()->route('admin.login')->withErrors('You are not Authorized to access this page');
                    }
                }
            }
        } else {
            
            return back()->withErrors([
                'email' => 'These credentials do not match our records.',     // If authentication fails, redirect back with an error
            ]);
        }

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
        } else {
            return back()->with('error', 'Role not found.');
        }

        // Redirect after successful registration
        return redirect()->route('dashboard')->with('success', 'Registration successful!');
    }


    public function logout()
    {
        // Secure and clean logout process
        Auth::guard('admin')->logout();                   // Logs out the user
        session()->invalidate();            // Clears all session data
        session()->regenerateToken();       // Regenerates the CSRF token
        
        return redirect()->route('admin.login');
    }

}
