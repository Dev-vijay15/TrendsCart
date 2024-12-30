<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;
use Spatie\Permission\Models\Role;

class usersController extends Controller //implements HasMiddleware
{

    // public static function middleware()
    // {
    //     return[
    //         new Middleware ('permission:read users', only : ['index']),
    //         new Middleware ('permission:edit users', only : ['edit']),
    //         new Middleware ('permission:create users', only : ['create']),
    //         new Middleware ('permission:delete users', only : ['destroy']),
    //     ];
    // }

    public function index()
    {

        $users = User::latest()->paginate(5);
// dd($users);
        return view('backend.users.index', compact('users'));
    }

    //this method will show create user

    public function create()
    {
        // return view('backend.users.create');
    }

    // public function store(Request $request)
    // {
    //     try {
    //         // Validate the input
    //         $validator = Validator::make($request->all(), [
    //             'first_name' => 'required|min:3',
    //             'last_name' => 'required|min:3',
    //             'email'=>'required|unique:users',
    //             'password'=>'required',
    //         ]);

    //         // If validation fails, return the validation errors
    //         if ($validator->fails()) {
    //             return response()->json([
    //                 'errors' => $validator->errors()
    //             ], 422);
    //         }

    //         // Create the new user
    //         User::create([
    //             'name' => $request->name
    //         ]);

    //         return response()->json([
    //             'message' => 'user added successfully.'
    //         ], 200);
    //     } catch (\Exception $e) {
    //         // Return a generic error message
    //         return response()->json([
    //             'error' => 'An error occurred: ' . $e->getMessage()
    //         ], 500);
    //     }
    // }


    public function edit($id)
    {
        $user = User::findOrFail($id);
        $roles=Role::orderBy('name','ASC')->get();
        $hasRoles=$user->roles->pluck('id');

        return view('backend.users.edit', compact('user','roles','hasRoles'));
    }


    public function update(Request $request, $id)
    {
        // dd($request->all());
        try {
            // Validate the input
            $validated = $request->validate([
                'first_name' => 'required|string|min:3|regex:/^[a-zA-Z\s]+$/',
            ]);

            // Find the user by id and update
            $user = User::findOrFail($id);
            // dd($user);
            $user->first_name = $request->first_name;
            $user->save();
           
            $roleId=$user->syncRoles($request->role);
            
            return response()->json(['message' => 'user updated successfully.']);
        } catch (\Exception $e) {
            // Handle any errors or exceptions
            return response()->json(['error' => 'Something went wrong: ' . $e->getMessage()], 500);
        }
    }



        public function show($id)
        {
            $user = User::findOrFail($id);

            return response()->json([
                'name' => $user->name,
                'created_at' => $user->created_at->format('d M, Y')
            ]);
        }


    public function destroy($id)
    {
        try {
            $user = user::findOrFail($id);
            $user->delete();

            return response()->json(['message' => 'user deleted successfully.']);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Error: ' . $e->getMessage()], 500);
        }
    }

}
