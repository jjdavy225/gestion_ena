<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;

class GestionUsersController extends Controller
{
    public function dashboard()
    {
        $users = User::all();
        $roles = Role::all();
        return view('admin.dashboard', compact('users', 'roles'));
    }

    public function show($id)
    {
        $user = User::find($id);
        $roles = Role::all();
        return view('admin.showUser', compact('user', 'roles'));
    }

    public function attributionRole(Request $request)
    {
        $request->validate([
            'user' => ['required','numeric'],
            'role' => ['required','numeric'],
        ]);

        $user = User::find($request->user);
        if ($user->role_id != null) {
            return back()->with('error','Une erreur est survenue');
        }
        else {
            $user->role_id = $request->role;
            $user->save();
            return back()->with('info','Attribution éffectuée avec succès');
        }
    }

    public function modificationRole(Request $request)
    {
        $request->validate([
            'user' => ['required','numeric'],
            'role' => ['required','numeric'],
        ]);

        $user = User::find($request->user);
        if ($user->role_id == null) {
            return back()->with('error','Une erreur est survenue');
        }
        else {
            $user->role_id = $request->role;
            $user->save();
            return back()->with('info','Modification éffectuée avec succès');
        }
    }
}
