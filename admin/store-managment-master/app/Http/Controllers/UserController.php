<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserStoreRequest;
use App\Http\Requests\UserUpdateRequest;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Permission;

class UserController extends Controller
{

    public function index()
    {
        $users = User::paginate(100);
        $users->map(function ($user) {
            $user['permission'] = $user->permission;
        });

        return inertia()->render('Dashboard/users/index', [
            'users' => $users
        ]);
    }

    public function create()
    {
        $permissions = Permission::all()->pluck('name');

        return inertia()->render('Dashboard/users/create', [
            'permissions' => $permissions,
        ]);
    }

    public function store(UserStoreRequest $request)
    {

        $request->validated();
        $user = User::create([
            'name' => $request->name,
            'username' => $request->username,
            'phone' => $request->phone,
            'alt_phone' => $request->alt_phone,
            'address' => $request->address,
            'balance' => $request->balance,
            'password' => Hash::make($request->password),
        ]);

        $user->syncPermissions($request->permission);

        session()->flash('toast', [
            'type' => 'success',
            'message' => 'تم أضافة المستخدم'
        ]);

        return redirect()->route('users.index');

    }

    public function edit(User $user)
    {
        $permissions = Permission::all()->pluck('name');
        $user['permission'] = $user->permissions->pluck('name')->first();

        return inertia()->render('Dashboard/users/edit', [
            'user' => $user,
            'permissions' => $permissions,
        ]);

    }

    public function update(UserUpdateRequest $request, User $user)
    {
        $data = $request->validated();

        if ($request->filled('password')) {
            $data['password'] = Hash::make($data['password']);
        }

        $user->update($data);
        $user->syncPermissions($request->permission);

        session()->flash('toast', [
            'type' => 'success',
            'message' => 'تم تعديل المستخدم'
        ]);

        return redirect()->route('users.index');

    }

    public function destroy(User $user)
    {
        $user->delete();

        return redirect()->route('users.index');
        session()->flash('toast', [
            'type' => 'success',
            'message' => 'تم حذف المستخدم'
        ]);
    }
}
