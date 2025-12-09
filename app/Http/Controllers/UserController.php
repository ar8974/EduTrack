<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Role;
use App\Models\Department;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    // GET /users
    public function index()
    {
        $users = User::with('role', 'department')->orderBy('user_id', 'desc')->get();
        return view('users.index', compact('users'));
    }

    // GET /users/create
    public function create()
    {
        $roles = Role::all();
        $departments = Department::all();
        return view('users.create', compact('roles', 'departments'));
    }

    // POST /users
    public function store(Request $request)
    {
        $data = $request->validate([
            'first_name' => 'required|string|max:100',
            'last_name'  => 'required|string|max:100',
            'email'      => 'required|email|unique:AR8974_USER,email',
            'password'   => 'required|string|min:6|confirmed',
            'role_id'    => 'required|integer|exists:AR8974_ROLE,role_id',
            'dept_id'    => 'nullable|integer|exists:AR8974_DEPARTMENT,dept_id',
            'is_active'  => 'nullable|boolean',
        ]);

        $user = User::create([
            'first_name'    => $data['first_name'],
            'last_name'     => $data['last_name'],
            'email'         => $data['email'],
            'password_hash' => Hash::make($data['password']),
            'role_id'       => $data['role_id'],
            'dept_id'       => $data['dept_id'] ?? null,
            'is_active'     => isset($data['is_active']) ? (bool)$data['is_active'] : true,
        ]);

        return redirect()->route('users.index')->with('success', 'User created successfully.');
    }

    // GET /users/{user}/edit
    public function edit(User $user)
    {
        $roles = Role::all();
        $departments = Department::all();
        return view('users.edit', compact('user', 'roles', 'departments'));
    }

    // PUT /users/{user}
    public function update(Request $request, User $user)
    {
        $data = $request->validate([
            'first_name' => 'required|string|max:100',
            'last_name'  => 'required|string|max:100',
            'email'      => ['required','email', Rule::unique('AR8974_USER','email')->ignore($user->user_id, 'user_id')],
            'password'   => 'nullable|string|min:6|confirmed',
            'role_id'    => 'required|integer|exists:AR8974_ROLE,role_id',
            'dept_id'    => 'nullable|integer|exists:AR8974_DEPARTMENT,dept_id',
            'is_active'  => 'nullable|boolean',
        ]);

        $user->first_name = $data['first_name'];
        $user->last_name  = $data['last_name'];
        $user->email      = $data['email'];
        $user->role_id    = $data['role_id'];
        $user->dept_id    = $data['dept_id'] ?? null;
        $user->is_active  = isset($data['is_active']) ? (bool)$data['is_active'] : false;

        if (!empty($data['password'])) {
            $user->password_hash = Hash::make($data['password']);
        }

        $user->save();

        return redirect()->route('users.index')->with('success', 'User updated successfully.');
    }

    // DELETE /users/{user}
    public function destroy(User $user)
    {
        $user->delete();
        return redirect()->route('users.index')->with('success', 'User deleted.');
    }
}
