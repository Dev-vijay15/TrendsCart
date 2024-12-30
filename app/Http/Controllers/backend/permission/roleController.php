<?php

namespace App\Http\Controllers\backend\permission;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;

class roleController extends Controller //implements HasMiddleware
{

    // public static function middleware()
    // {
    //     return[
    //         new Middleware ('permission:read roles', only : ['index']),
    //         new Middleware ('permission:edit roles', only : ['edit']),
    //         new Middleware ('permission:create roles', only : ['create']),
    //         new Middleware ('permission:delete roles', only : ['destroy']),
    //     ];
    // }

    //this method will show all permission

    public function index()
    {

        $roles = Role::orderBy('created_at', 'Desc')->paginate(10);

        return view('backend.role.index', compact('roles'));
    }

    //this method will show create permission

    public function create()
    {
        $permissions = Permission::orderBy('name', 'ASC')->get();

        return view('backend.role.create', compact('permissions'));
    }

    // Store the new role and its permissions
    public function store(Request $request)
    {
       
        // Validate the incoming request
        try {
            $validator = Validator::make($request->all(), [
                'name' => 'required|string|unique:roles|min:3|',
              
            ]);
           
            if ($validator->passes()) {
                $role = Role::create(['name' => $request->name]);
               
                if (!empty($request->permission)) {
                    foreach ($request->permission as $permissionName) {
                        $role->givePermissionTo($permissionName);
                    }
                }
              
                return response()->json([
                    'message' => 'Role added successfully.'
                ], 200);
            } else {
                return response()->json([
                    'error' => true,
                    'message' => $validator->errors()->first()
                ], 422);
            }
        } catch (\Exception $e) {
            // Return a generic error message
            return response()->json([
                'error' => 'An error occurred: ' . $e->getMessage()
            ], 500);
        }
    }




    public function edit($id)
    {
        $role = Role::findOrFail($id);
        $hasPermissions = $role->permissions->pluck('name');
        $permissions = Permission::orderBy('name', 'ASC')->get();

        return view('backend.role.edit', compact('role','permissions','hasPermissions'));
    }


    public function update(Request $request, $id)
    {
         // Find the rols by id and update
        $role = Role::findOrFail($id);
        try {
            // Validate the input
            $validator = Validator::make($request->all(), [
                'name' => 'required|unique:roles,name,'.$id.',id',
                'permission' => 'required|array|min:1', // At least one permission must be selected
            ]);
           
            if ($validator->passes()) {

                $role->name = $request->name;
                $role->save();

                if (!empty($request->permission)) {
                 
                        $role->syncPermissions($request->permission);  
                }
                else{
                    $role->syncPermissions([]);
                }

            } else {
                return response()->json([
                    'error' => true,
                    'message' => $validator->errors()->first()
                ], 422);
            }
            return response()->json(['message' => 'Roles updated successfully.']);
        } catch (\Exception $e) {
            // Handle any errors or exceptions
            return response()->json(['error' => 'Something went wrong: ' . $e->getMessage()], 500);
        }
    }



    public function show($id)
    {
        $permission = Role::findOrFail($id);

        return response()->json([
            'name' => $permission->name,
            'created_at' => $permission->created_at->format('d M, Y')
        ]);
    }


    public function destroy($id)
    {
        try {
            $role = Role::findOrFail($id);

            if($role==null){
                session()->flush('error','role not found');
                return response()->json([
                    'status'=>false
                ]);
            }
            $role->delete();

            return response()->json(['message' => 'Role deleted successfully.']);
            
        } catch (\Exception $e) {
            return response()->json(['message' => 'Error: ' . $e->getMessage()], 500);
        }
    }
}
