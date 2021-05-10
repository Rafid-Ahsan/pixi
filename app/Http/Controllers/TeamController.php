<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;

class TeamController extends Controller
{
    public function index() {
        $users = User::paginate(10);
        $roles = Role::get();

        return view('admin.team', [
            'users' => $users,
            'roles' => $roles
        ]);
    }

    public function update(User $user, Request $request) {
        $user->assignRole($request->role);

        return redirect('/team')->with('success', 'Team updated Succesfully');
    }

    public function delete(User $user, Request $request) {
        if($request->all == null) {
            $role = $user->roles->pluck('name')->first();
            $user->removeRole($role);

            return redirect('/team')->with('success', 'Team updated Succesfully');
        }   else {
            return redirect('/team')->with('success', 'That user has no role');
        }
    }
}
