<?php

namespace App\Http\Controllers\Admin\Settings;

use App\Models\Permission;
use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Inertia\Inertia;

class RoleController extends Controller
{
    function __construct()
    {
         $this->middleware('can:role list', ['only' => ['index','show']]);
         $this->middleware('can:role create', ['only' => ['create','store']]);
         $this->middleware('can:role edit', ['only' => ['edit','update']]);
         $this->middleware('can:role delete', ['only' => ['destroy']]);
    }
    
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        return Inertia::render('Admin/Setting/Role/list', [
            'list'  => Role::all(),
            'can'   => [
                'create'    => Auth::user()->can('role create'),
                'edit'      => Auth::user()->can('role edit'),
                'delete'    => Auth::user()->can('role delete'),
            ]
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        Role::create(
            $request->validate([
                'name' => ['required', 'max:50'],
                'guard_name' => ['required', 'max:50'],
            ])
        );
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        // $permissions = $this->roleHasPermissions($id);
        // $p = Role::find(3);
        // // return $permissions;
        // return Inertia::render('Role/hasPermission', [
        //     'list'     => $permissions,
        //     'lsp'       => count($p->permissions),
        //     'can'      => [
        //         'edit'      => Auth::user()->can('role edit'),
        //     ]
        // ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Role $role)
    {
        $permissions = Permission::all();
        $roleHasPermissions = $role->permissions->pluck('id')->toArray();

        return Inertia::render('Admin/Setting/Role/hasPermission', [
            'role' => $role,
            'permissions' => $permissions,
            'roleHasPermissions' => $roleHasPermissions,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Role $role)
    {
        $request->validate([
            'permissions' => 'array'
        ]);

        if (!$role) {
            return back()->with('error', 'Role not found');
        }

        if (!$request->name) {
            $role->update(['name' => $request->name]);
        }

        $permissions = $request->permissions ?? [];

        $role->syncPermissions($permissions);

        return redirect()->route('role.index')
                            ->with('message', 'Role updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Role $role)
    {
        $role->delete();
    }
    
    /**
     * get all permission and the one that role has
     *
     * @param  mixed $id
     * @return void
     */
    public function roleHasPermissions($id)
    {
         $roleHas = DB::table('Roles', 'r')
                        ->select('r.name as role_name', 'rhp.*')
                        ->leftJoin('role_has_permissions as rhp', 'r.id', '=', 'rhp.role_id')
                        ->where('rhp.role_id', '=', $id);

        $permissions = DB::table('permissions', 'p')
                        ->select('rh.*', 'p.name as permission_name')
                        ->joinSub($roleHas, 'rh', 'rh.permission_id', '=', 'p.id', 'left')->get();

        return $permissions;
    }

}
