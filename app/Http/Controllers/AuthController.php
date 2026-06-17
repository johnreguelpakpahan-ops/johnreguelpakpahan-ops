<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Mail\OtpResetPasswordMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Carbon\Carbon;

class AuthController extends Controller
{

    public function showLogin()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email'    => 'required|email',
            'password' => 'required',
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()->intended('/admin');
        }

        return back()->withErrors(['email' => 'Email atau password salah.']);
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }

    public function showForgotForm()
    {
        return view('auth.forgot-password');
    }

    public function sendOtp(Request $request)
    {
        $request->validate([
            'email' => 'required|email|exists:admin,email'
        ]);

        $otp = str_pad(random_int(0, 999999), 6, '0', STR_PAD_LEFT);

        DB::table('password_resets')->where('email', $request->email)->delete();
        DB::table('password_resets')->insert([
            'email'      => $request->email,
            'token'      => $otp,
            'created_at' => Carbon::now(),
        ]);

        try {
            Mail::to($request->email)->send(new OtpResetPasswordMail($otp, $request->email));

            session(['otp_email' => $request->email]);

            return redirect()->route('password.verify-otp')
                ->with('success', 'Kode OTP 6 digit telah dikirim ke ' . $request->email . '. Berlaku 10 menit.');
        } catch (\Exception $e) {
            return back()->withErrors(['email' => 'Gagal mengirim email: ' . $e->getMessage()]);
        }
    }

    public function showVerifyOtp()
    {
        if (!session('otp_email')) {
            return redirect()->route('password.request');
        }
        return view('auth.verify-otp');
    }

    public function verifyOtp(Request $request)
    {
        $request->validate([
            'otp' => 'required|string|size:6',
        ]);

        $email = session('otp_email');
        if (!$email) {
            return redirect()->route('password.request')->withErrors(['otp' => 'Sesi habis. Silakan ulangi.']);
        }

        $record = DB::table('password_resets')
            ->where('email', $email)
            ->where('token', $request->otp)
            ->first();

        if (!$record) {
            return back()->withErrors(['otp' => 'Kode OTP salah. Silakan coba lagi.']);
        }

        if (Carbon::now()->diffInMinutes(Carbon::parse($record->created_at)) > 10) {
            DB::table('password_resets')->where('email', $email)->delete();
            session()->forget('otp_email');
            return redirect()->route('password.request')
                ->withErrors(['email' => 'Kode OTP sudah kadaluarsa. Silakan request ulang.']);
        }

        session(['otp_verified' => true]);
        return redirect()->route('password.reset-form');
    }

    public function showResetForm()
    {
        if (!session('otp_email') || !session('otp_verified')) {
            return redirect()->route('password.request');
        }
        return view('auth.reset-password');
    }

    public function resetPassword(Request $request)
    {
        $request->validate([
            'password' => 'required|min:6|confirmed',
        ]);

        $email = session('otp_email');
        if (!$email || !session('otp_verified')) {
            return redirect()->route('password.request');
        }

        Admin::where('email', $email)->update([
            'password' => Hash::make($request->password),
        ]);

        DB::table('password_resets')->where('email', $email)->delete();
        session()->forget(['otp_email', 'otp_verified']);

        return redirect()->route('login')
            ->with('success', 'Password berhasil diubah! Silakan login dengan password baru Anda.');
    }
}