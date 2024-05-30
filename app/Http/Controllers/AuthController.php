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

        $credentials = $request->only('username', 'password');

        if (Auth::attempt($credentials)) {
            $user = Auth::user();
            if ($user->status !== 'approved') {
                Auth::logout();
                return back()->withErrors(['login' => 'Account not approved by admin.']);
            }

            // Check if the password is the default reset password
            if (Hash::check('ispat1234567', $user->password)) {
                return redirect()->route('user.reset-password.form');
            }

            return redirect()->intended('file-list');
        }

        return back()->withErrors(['login' => 'Invalid login credentials.']);
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
            'username' => 'required',
            'email' => 'required',
            'password' => 'required',
            'role' => 'required',
            'dep_id' => 'required',
            'comp_id' => 'required',
        ]);

        User::create([
            'code_emp' => $request->input('code_emp'),
            'username' => $request->input('username'),
            'email' => $request->input('email'),
            'password' => Hash::make($request->input('password')),
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

    public function showResetPasswordForm()
    {
        $users = User::all();
        return view('auth.reset_password', compact('users'));
    }

    public function resetPassword(Request $request)
    {
        $request->validate([
            'code_emp' => 'required|exists:users,code_emp',
        ]);

        $user = User::where('code_emp', $request->input('code_emp'))->first();
        if (!$user) {
            return redirect()->route('admin.reset-password.form')->with('error', 'User not found.');
        }

        try {
            $user->password = Hash::make('ispat1234567');
            $user->save();
            return redirect()->route('admin.reset-password.form')->with('success', 'Password has been reset successfully.');
        } catch (\Exception $e) {
            return redirect()->route('admin.reset-password.form')->with('error', 'Failed to reset password: ' . $e->getMessage());
        }
    }

    public function showSetNewPasswordForm()
    {
        return view('auth.set_new_password');
    }

    public function setNewPassword(Request $request)
    {
        $request->validate([
            'password' => 'required|string|min:6|confirmed',
        ]);

        $user = Auth::user();
        $user->password = Hash::make($request->input('password'));
        $user->save();

        return redirect('/home')->with('success', 'Password has been changed successfully.');
    }

    public function viewapproved()
    {
        $users = User::where('status', 'pending')->get();
        return view('auth.approve_user', compact('users'));
    }

    public function approveUser($code_emp)
    {
        $user = User::where('code_emp', $code_emp)->first();
        if (!$user) {
            return redirect()->back()->with('error', 'User not found.');
        }

        $user->status = 'approved';
        $user->save();

        return redirect()->back()->with('success', 'User approved successfully.');
    }

    public function rejectUser($code_emp)
    {
        $user = User::where('code_emp', $code_emp)->first();
        if (!$user) {
            return redirect()->back()->with('error', 'User not found.');
        }

        $user->delete();

        return redirect()->back()->with('success', 'User rejected and deleted successfully.');
    }

    public function userDetail($code_emp)
    {
        $user = User::where('code_emp', $code_emp)->first();
        if (!$user) {
            return redirect()->back()->with('error', 'User not found.');
        }

        return view('auth.user_detail', compact('user'));
    }
}
