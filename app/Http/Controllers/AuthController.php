<?php 

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class AuthController extends Controller
{
    public function showLogin()
    {
        return view('auth.login');
    }

   public function login(Request $request)
{
    $request->validate([
        'email'    => 'required|email',
        'password' => 'required',
        'role'     => 'required'
    ]);

    // Map form role string to role_id in DB
    $roleMap = [
        'ADMIN'   => 1,
        'FACULTY' => 2,
        'STUDENT' => 3,
    ];

    $role_id = $roleMap[$request->role] ?? null;

    if (!$role_id) {
        return back()->with('error', 'Invalid role selected.');
    }

    $user = User::where('email', $request->email)
                ->where('role_id', $role_id)
                ->first();

    if (!$user || !Hash::check($request->password, $user->password_hash)) {
        return back()->with('error', 'Invalid credentials.');
    }

    Auth::login($user);
    Session::put('user_id', $user->user_id);

    // Redirect based on role
    if ($role_id == 1) return redirect()->route('dashboard');           // Admin
    if ($role_id == 2) return redirect()->route('faculty.dashboard');   // Faculty
    if ($role_id == 3) return redirect()->route('student.dashboard');   // Student
}

    public function logout()
    {
        Auth::logout();
        return redirect()->route('login');
    }
}
