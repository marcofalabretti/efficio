<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'can:manage-users']);
    }

    public function index()
    {
        $users = User::orderBy('name')->paginate(15);
        $roles = ['admin', 'manager', 'sales', 'user'];
        return view('admin.users.index', compact('users', 'roles'));
    }

    public function update(Request $request, User $user)
    {
        $data = $request->validate([
            'role' => ['required', 'in:admin,manager,sales,user'],
        ]);

        $user->update(['role' => $data['role']]);

        return back()->with('success', 'Ruolo aggiornato per '.$user->name);
    }
}


