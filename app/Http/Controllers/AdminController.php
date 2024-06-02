<?php

namespace App\Http\Controllers;

use App\Models\DetailPeminjaman;
use App\Models\Peminjam;
use App\Models\Peminjaman;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class AdminController extends Controller
{
    public function index()
    {

        $peminjaman = Peminjaman::with('admin', 'peminjam')->get();
        return Inertia::render('Admin/DaftarPeminjaman', [
            'peminjaman' => $peminjaman,
        ]);

    }

    public function updateStatus(Request $request)
    {
        $peminjaman = Peminjaman::where('kode_pinjam', $request->kode_pinjam)->first();
        $peminjaman->status_peminjaman = $request->status_peminjaman;
        $peminjaman->id_admin = Auth::guard('admin')->user()->id_admin;
        $peminjaman->save();
    }

    public function detail(Request $request)
    {
        $detail = DetailPeminjaman::where('kode_pinjam', $request->kode_pinjam)->with('Buku')->get();

        return Inertia::render('Admin/DetailPeminjaman', [
            'detail' => $detail,
        ]);
    }

    public function delete(Request $request)
    {
        $detail = DetailPeminjaman::find($request->id_detail);
        // dd($detail);
        $detail->delete();
    }

    public function listPeminjam(Request $request)
    {
        $peminjam = Peminjam::get();
        return Inertia::render('Admin/DaftarUser', [
            'peminjam' => $peminjam,
        ]);
    }

    public function updateUser(Request $request)
    {
        // dd($request->all());
        $peminjam = Peminjam::where('id_peminjam', $request->id_peminjam)->first();
        $peminjam->status_peminjam = $request->status_peminjam;
        $peminjam->save();
    }

}
