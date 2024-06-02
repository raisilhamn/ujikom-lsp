<?php
namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\Peminjam;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Inertia\Inertia;

class AuthController extends Controller
{

    public function loginAdmin(Request $request)
    {
        $request->validate([
            'user_admin' => 'required|string',
            'pass_admin' => 'required|string',
        ]);

        $user = Admin::where('user_admin', $request->user_admin)->first();

        if ($user && Hash::check($request->pass_admin, $user->pass_admin)) {
            Auth::guard('admin')->login($user);
            $request->session()->regenerate();
            return redirect(route('admin.pemesanan'));
        }

        return back()->withErrors([
            'user_admin' => 'The provided credentials do not match our records.',
        ]);
    }

    public function loginPeminjam(Request $request)
    {
        $request->validate([
            'user_peminjam' => 'required|string',
            'password_peminjam' => 'required|string',
        ]);

        // dd($request->all());

        $user = Peminjam::where('user_peminjam', $request->user_peminjam)->first();

        if ($user && Hash::check($request->password_peminjam, $user->password_peminjam)) {
            Auth::guard('peminjam')->login($user);
            $request->session()->regenerate();
            return redirect(route('index'));
        }

        return back()->withErrors([
            'user_peminjam' => 'Tidak sesuai credentials do not match our records.',
        ]);
    }

    public function loginUserIndex()
    {
        return Inertia::render('Auth/LoginUser', [
            'status' => session('status'),
        ]);
    }

    public function loginAdminIndex()
    {
        return Inertia::render('Auth/Login', [
            'status' => session('status'),
        ]);
    }

    public function registerIndex()
    {
        return Inertia::render('Auth/Register');
    }

    public function registerIndexPeminjam()
    {
        return Inertia::render('Auth/RegisterUser');
    }

    public function registerAdmin(Request $request)
    {
        // dd($request->all());
        $request->validate([
            'nama_admin' => 'required|string',
            'user_admin' => 'required|string|unique:admin',
            'pass_admin' => 'required|string',
        ]);

        $admin = Admin::create([
            'nama_admin' => $request->nama_admin,
            'user_admin' => $request->user_admin,
            'pass_admin' => Hash::make($request->pass_admin),
        ]);

        Auth::guard('admin')->login($admin);

        return redirect(route('admin.pemesanan'));
    }

    public function registerPeminjam(Request $request)
    {
        $request->validate([
            'nama_peminjam' => 'required|string',
            'user_peminjam' => 'required|string|unique:peminjam',
            'password_peminjam' => 'required|string',
            'foto_peminjam' => 'required|file', // Add this line
        ]);

        $filePath = $request->foto_peminjam->store('public/image');
        $fileName = Storage::url($filePath);

        $peminjam = Peminjam::create([
            'tgl_daftar' => now()->format('Y-m-d'),
            'nama_peminjam' => $request->nama_peminjam,
            'user_peminjam' => $request->user_peminjam,
            'password_peminjam' => Hash::make($request->password_peminjam),
            'foto_peminjam' => $fileName, // Add this line
        ]);

        Auth::guard('peminjam')->login($peminjam);
        return redirect(route('index'));
    }

    public function logout(Request $request)
    {
        if (Auth::guard('admin')->check()) {
            Auth::guard('admin')->logout();
        }

        if (Auth::guard('peminjam')->check()) {
            Auth::guard('peminjam')->logout();
        }

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect(route('index'));
    }

}
