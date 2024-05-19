<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Dep;
use App\Models\Company;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'username' => 'required|string',
            'password' => 'required|string',
        ]);

        $user = User::where('username', $request->input('username'))
                    ->where('password', $request->input('password'))
                    ->where('status', "approved")
                    ->first();

        if ($user) {
            Auth::login($user);
            return redirect()->intended('file-list');
        }

        return back()->withErrors(['login' => 'Invalid login credentials or Acount no approve admin']);
    }

    public function showRegisterForm()
    {
        $departments = Dep::all();
        $companys = Company::all();
        return view('auth.register', compact('departments', 'companys'));
    }

    public function register(Request $request)
    {
        $request->validate([
            'code_emp' => 'required|string|unique:users',
            'username' => 'required|string|unique:users',
            'password' => 'required|string|min:6|confirmed',
            'role' => 'required|string',
            'dep_id' => 'required|string',
            'comp_id' => 'required|string',
        ]);

        User::create([
            'code_emp' => $request->input('code_emp'),
            'username' => $request->input('username'),
            'password' => $request->input('password'),
            'role' => $request->input('role'),
            'dep_id' => $request->input('dep_id'),
            'comp_id' => $request->input('comp_id'),
            'status' => 'pending', // Set status pending
        ]);

        return redirect('/login')->with('success', 'Account created successfully. Please wait for admin approval.');
    }

    public function logout(Request $request)
    {
        Auth::logout(); // Logout user

        $request->session()->invalidate(); // Invalidate session
        $request->session()->regenerateToken(); // Regenerate CSRF token

        return redirect('/login'); // Redirect ke halaman login
    }

    public function viewapproved()
    {
        // Mengambil daftar pengguna yang statusnya 'pending'
        $users = User::where('status', 'pending')->get();

        return view('auth.approve_user', compact('users'));
    }


    public function approveUser($code_emp)
    {
        $user = User::find($code_emp);
        if (!$user) {
            return redirect()->back()->with('error', 'User not found.');
        }

        // Mengubah status user menjadi "approved"
        $user->status = 'approved';
        $user->save();

        return redirect()->back()->with('success', 'User approved successfully.');
    }

    public function rejectUser($code_emp)
    {
        $user = User::find($code_emp);
        if (!$user) {
            return redirect()->back()->with('error', 'User not found.');
        }

        // Menghapus user
        $user->delete();

        return redirect()->back()->with('success', 'User rejected and deleted successfully.');
    }

    public function userDetail($code_emp)
    {
        $user = User::find($code_emp);
        if (!$user) {
            return redirect()->back()->with('error', 'User not found.');
        }

        return view('auth.user_detail', compact('user'));
    }
}
