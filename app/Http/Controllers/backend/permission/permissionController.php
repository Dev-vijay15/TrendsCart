<?php

namespace App\Http\Controllers\backend\permission;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Spatie\Permission\Models\Permission;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;

class permissionController extends Controller implements HasMiddleware
{

    public static function middleware()
    {
        return[
            new Middleware ('permission:read permissions', only : ['index']),
            new Middleware ('permission:edit permissions', only : ['edit']),
            new Middleware ('permission:create permissions', only : ['create']),
            new Middleware ('permission:delete permissions', only : ['destroy']),
        ];
    }

    //this method will show all permission

    public function index()
    {

        $permissions = Permission::orderBy('created_at', 'Desc')->paginate(10);

        return view('backend.permission.index', compact('permissions'));
    }

    //this method will show create permission

    public function create()
    {
        return view('backend.permission.create');
    }

    public function store(Request $request)
    {
        try {
            // Validate the input
            $validator = Validator::make($request->all(), [
                'name' => 'required|unique:permissions|min:3',
            ]);

            // If validation fails, return the validation errors
            if ($validator->fails()) {
                return response()->json([
                    'errors' => $validator->errors()
                ], 422);
            }

            // Create the new permission
            Permission::create([
                'name' => $request->name
            ]);

            return response()->json([
                'message' => 'Permission added successfully.'
            ], 200);
        } catch (\Exception $e) {
            // Return a generic error message
            return response()->json([
                'error' => 'An error occurred: ' . $e->getMessage()
            ], 500);
        }
    }


    public function edit($id)
    {
        $permission = Permission::findOrFail($id);

        return view('backend.permission.edit', compact('permission'));
    }


    public function update(Request $request, $id)
    {
        try {
            // Validate the input
            $validated = $request->validate([
                'name' => 'required|string|min:3|regex:/^[a-zA-Z\s]+$/',
            ]);

            // Find the permission by id and update
            $permission = Permission::findOrFail($id);
            $permission->name = $request->name;
            $permission->save();

            return response()->json(['message' => 'Permission updated successfully.']);
        } catch (\Exception $e) {
            // Handle any errors or exceptions
            return response()->json(['error' => 'Something went wrong: ' . $e->getMessage()], 500);
        }
    }



        public function show($id)
        {
            $permission = Permission::findOrFail($id);

            return response()->json([
                'name' => $permission->name,
                'created_at' => $permission->created_at->format('d M, Y')
            ]);
        }


    public function destroy($id)
    {
        try {
            $permission = Permission::findOrFail($id);
            $permission->delete();

            return response()->json(['message' => 'Permission deleted successfully.']);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Error: ' . $e->getMessage()], 500);
        }
    }
}
