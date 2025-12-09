<?php

namespace App\Http\Controllers;

use App\Models\Role;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    // List all roles
    public function index()
    {
        $roles = Role::orderBy('role_name')->get();
        return view('roles.index', compact('roles'));
    }

    // Show create form
    public function create()
    {
        return view('roles.create');
    }

    // Store new role
    public function store(Request $request)
    {
        $data = $request->validate([
            'role_name' => 'required|string|max:50|unique:AR8974_ROLE,role_name',
        ]);

        Role::create($data);

        return redirect()->route('roles.index')->with('success', 'Role created successfully.');
    }

    // Show edit form
    public function edit(Role $role)
    {
        return view('roles.edit', compact('role'));
    }

    // Update existing role
    public function update(Request $request, Role $role)
    {
        $data = $request->validate([
            'role_name' => 'required|string|max:50|unique:AR8974_ROLE,role_name,' . $role->role_id . ',role_id',
        ]);

        $role->update($data);

        return redirect()->route('roles.index')->with('success', 'Role updated successfully.');
    }

    // Delete a role
    public function destroy(Role $role)
    {
        $role->delete();
        return redirect()->route('roles.index')->with('success', 'Role deleted successfully.');
    }
}
