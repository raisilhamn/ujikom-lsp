<?php

namespace App\Http\Controllers;

use App\Models\Buku;
use App\Models\DetailPeminjaman;
use App\Models\Peminjaman;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Inertia\Inertia;

class CustomerController extends Controller
{
    // daftar pinjaman
    public function index(Request $request)
    {
        $buku = Buku::all();

        // return the session

        // inertia
        return Inertia::render('Customer/Checkout', [
            'buku' => $buku,

        ]);
    }

    public function addbook(Request $request)
    {

        $bookIds = $request->bookids; // assuming 'bookids' is an array of book IDs
        $request->session()->put('bookIds', $bookIds);

    }

    public function addToBuku(Request $request)
    {
        $id = $request->id;
        $buku = Buku::find($request->id);

        $cart = Session::get('buku');

        if (!$cart) {
            $cart = [
                $id => [
                    "id_buku" => $buku->id_buku, // "id_buku" => "1
                    "nama_penerbit" => $buku->nama_penerbit,
                    "nama_pengarang" => $buku->nama_penerbit,
                    "judul_buku" => $buku->judul_buku,
                ],
            ];

            Session::put('buku', $cart);
            return redirect()->back()->with('success', 'Buku added to cart successfully!');
        }
        $cart[$id] = [
            "id_buku" => $buku->id_buku, // "id_buku" => "1

            "nama_penerbit" => $buku->nama_penerbit,
            "nama_pengarang" => $buku->nama_penerbit,
            "judul_buku" => $buku->judul_buku,
        ];
        Session::put('buku', $cart);
        // toastr()->success('Data has been saved successfully!');
        return redirect()->back()->with('success', 'Buku added to cart successfully!');
    }

    public function checkSession()
    {
        $buku = Session::get('buku');
        // forget session
        Session::forget('buku');

        return response()->json($buku);

    }

    public function formPeminjaman()
    {
        $buku = Session::get('buku');

        return Inertia::render('Customer/FormPeminjaman', [
            'buku' => $buku,
        ]);
    }

    public function deleteFromPeminjaman(Request $request)
    {
        $id = $request->id;
        $cart = Session::get('buku');
        if (isset($cart[$id])) {
            unset($cart[$id]);
            Session::put('buku', $cart);
        }
        return redirect()->back()->with('success', 'Buku removed from cart successfully!');
    }

    public function submitForm(Request $request)
    {
        $peminjaman = Peminjaman::create([
            'tgl_pesan' => Carbon::parse($request->tgl_pesan)->format('Y-m-d'),
            'tgl_wajibkembali' => Carbon::parse($request->tgl_wajibkembali)->format('Y-m-d'),
            'status_peminjaman' => "diproses",
            'id_peminjam' => Auth::guard('peminjam')->user()->id_peminjam,
        ]);

        // dd is session array, store the value of it to detail peminjaman
        $cart = Session::get('buku');
        foreach ($cart as $key => $value) {
            $peminjaman->detail_peminjaman()->create([
                'id_buku' => $value['id_buku'],
                'kode_pinjam' => $peminjaman->kode_pinjam,
            ]);
        }

        // forget session
        Session::forget('buku');

        return redirect()->route('customer.checkout');

    }

    // get the list of pesanan and detail pesanan that associate with
    public function getDetailPeminjaman()
    {
        $peminjaman = Peminjaman::where('id_peminjam', Auth::guard('peminjam')->user()->id_peminjam)->with('detail_peminjaman', 'admin')->get();

        return Inertia::render('Customer/DaftarPeminjaman', [
            'peminjaman' => $peminjaman,
            // 'detail' => $detail,
        ]);
    }
    public function detail(Request $request)
    {
        $peminjaman = Peminjaman::where('kode_pinjam', $request->kode_pinjam)->first();
        $detail = DetailPeminjaman::where('kode_pinjam', $request->kode_pinjam)->with('Buku')->get();

        return Inertia::render('Customer/DetailPeminjaman', [
            'detail' => $detail,
            'peminjaman' => $peminjaman,
        ]);
    }

    public function updateStatus(Request $request)
    {
        $peminjaman = Peminjaman::where('kode_pinjam', $request->kode_pinjam)->first();
        $peminjaman->status_peminjaman = "diambil";
        $peminjaman->tgl_ambil = Carbon::parse(now())->format('Y-m-d');
        $peminjaman->save();
    }

    public function kembalikan(Request $request)
    {
        $peminjaman = Peminjaman::where('kode_pinjam', $request->kode_pinjam)->first();
        $peminjaman->status_peminjaman = "selesai";
        $peminjaman->tgl_kembali = Carbon::parse(now())->format('Y-m-d');
        $peminjaman->save();

    }

}
