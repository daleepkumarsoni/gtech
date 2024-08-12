<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class HomeController extends Controller
{

    function login()
    {
        return view('admin.Auth.login');
    }
    function signup()
    {
        $role = DB::table('roles')->get();
        return view('admin.Auth.signup', compact('role'));
    }

    public function register(Request $request)
    {

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

       

        $user->roles()->attach($request->role);

        // Log the user in
        Auth::login($user);
        if ($user->roles()->where('name', 'Admin')->exists()) {
            return redirect()->route('admin.dashboard');
        } elseif ($user->roles()->where('name', 'Manager')->exists()) {
            return redirect()->route('manager.dashboard');
        } else {
            return redirect()->route('employee.dashboard');
        }
        // Redirect to the admin dashboard
    }

    public function Authlogin(Request $request)
    {
        // Validate the request
        $request->validate([
            'email' => 'required|string|email',
            'password' => 'required|string',
        ]);

        // Attempt to authenticate the user
        if (Auth::attempt($request->only('email', 'password'))) {
            // Fetch the authenticated user
            $user = Auth::user();

            // Check the user's role and redirect accordingly
            if ($user->roles()->where('name', 'Admin')->exists()) {
                return redirect()->route('admin.dashboard');
            } elseif ($user->roles()->where('name', 'Manager')->exists()) {
                return redirect()->route('manager.dashboard');
            } else {
                return redirect()->route('employee.dashboard');
            }
        }

        // If authentication fails, redirect back with error message
        return redirect()->route('login')->withErrors(['email' => 'Invalid credentials']);
    }


    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('login');
    }
    public  function index()
    {
        $auth = Auth::user()->name;
        return view('admin.module.index', compact('auth'));
    }
}
