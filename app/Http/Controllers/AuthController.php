<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Role;
use Illuminate\Support\Facades\Validator;
use App\Models\PasswordOtp;
use Illuminate\Support\Facades\Mail;
use Carbon\Carbon;

class AuthController extends Controller
{
    public function showLogin()
    {
        return view('login');
    }
    public function showRegister()
    {
        $roles = Role::all();
        return view('register', compact('roles'));
    }
    public function register(Request $request)
    {
        $request->merge([
            'email' => strtolower($request->email)
        ]);

        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',

            'email' => 'required|email:rfc,dns|unique:users,email',

            'password' => [
                'required',
                'min:8',
                'confirmed',
                'regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*#?&]).+$/'
            ],

            'roles' => 'required|array',
            'roles.*' => 'exists:roles,id'

        ], [
            'password.regex' => 'Password must contain uppercase, lowercase, number and special character.',
            'roles.required' => 'Please select at least one role.'
        ]);

        if ($validator->fails()) {
            return back()
                ->with('error', $validator->errors()->first())
                ->withInput();
        }

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        $user->roles()->attach($request->roles);

        Auth::login($user);

        return redirect()->route('login')
            ->with('success', 'You can Login now!');
    }

    public function login(Request $request)
    {
        $request->merge([
            'email' => strtolower($request->email)
        ]);

        $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        $user = User::where('email', $request->email)->first();

        if (!$user) {
            return back()
                ->with('error', 'Email does not exist.')
                ->withInput();
        }

        if (!Auth::attempt($request->only('email', 'password'))) {
            return back()
                ->with('error', 'Incorrect password.')
                ->withInput();
        }

        $request->session()->regenerate();

        return redirect()->route('dashboard')
            ->with('success', 'Welcome!');
    }
    public function showForgot()
    {
        return view('forgot-password');
    }

    public function sendOtp(Request $request)
    {
        $request->merge([
            'email' => strtolower($request->email)
        ]);

        $request->validate([
            'email' => 'required|email'
        ]);

        $user = User::where('email', $request->email)->first();

        if (!$user) {
            return back()->with('error', 'Email does not exist.');
        }

        $otp = random_int(100000, 999999);

        PasswordOtp::updateOrCreate(
            ['email' => $request->email],
            [
                'otp' => $otp,
                'expires_at' => Carbon::now()->addMinutes(5)
            ]
        );

        Mail::raw("Your FleetFlow password reset OTP is: $otp", function ($message) use ($request) {
            $message->to($request->email)
                ->subject('FleetFlow Password Reset OTP');
        });

        return redirect()->route('password.verify')
            ->with('success', 'OTP sent to your email.')
            ->with('email', $request->email);
    }
    public function showVerifyOtp(Request $request)
    {
        return view('verify-otp');
    }
    public function verifyOtp(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'otp' => 'required'
        ]);

        $record = PasswordOtp::where('email', $request->email)
            ->where('otp', $request->otp)
            ->where('expires_at', '>', Carbon::now())
            ->first();

        if (!$record) {
            return back()->with('error', 'Invalid or expired OTP.');
        }

        return view('reset-password', [
            'email' => $request->email
        ]);
    }
    public function resetPassword(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => [
                'required',
                'min:8',
                'confirmed',
                'regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*#?&]).+$/'
            ]
        ]);

        $user = User::where('email', $request->email)->first();

        if (!$user) {
            return redirect()->route('login')
                ->with('error', 'User not found.');
        }

        $user->update([
            'password' => Hash::make($request->password)
        ]);

        PasswordOtp::where('email', $request->email)->delete();

        return redirect()->route('login')
            ->with('success', 'Password reset successful.');
    }
    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login');
    }
}
