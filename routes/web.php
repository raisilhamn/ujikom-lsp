<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CustomerController;
use App\Http\Middleware\AdminMiddleware;
use App\Http\Middleware\PeminjamMiddleware;
use Illuminate\Support\Facades\Route;

require __DIR__ . '/auth.php';

Route::get('/', [CustomerController::class, 'index'])->name('index');

// route group middleware
Route::middleware(AdminMiddleware::class)->group(function () {
    Route::get('/pemesanan', [AdminController::class, 'index'])->name('admin.pemesanan');
    Route::get('/detail-pemesanan/{kode_pinjam}', [AdminController::class, 'detail'])->name('admin.detail');
    Route::patch('/update-status', [AdminController::class, 'updateStatus'])->name('admin.update');
    Route::delete('/delete/{id_detail}', [AdminController::class, 'delete'])->name('admin.delete');
    Route::patch('/update-user', [AdminController::class, 'updateUser'])->name('admin.update.user');
    Route::get('/daftar-peminjam', [AdminController::class, 'listPeminjam'])->name('admin.daftar.peminjam');
});

Route::middleware(PeminjamMiddleware::class)->group(function () {
    // Route::get('/peminjaman', [CustomerController::class, 'index'])->name('customer.peminjaman');
    // Route::get('/detail-peminjaman/{kode_pinjam}', [CustomerController::class, 'detail'])->name('customer.detail');
    // Route::patch('/update-status', [CustomerController::class, 'updateStatus'])->name('customer.update');
    // Route::delete('/delete/{id_detail}', [CustomerController::class, 'delete'])->name('customer.delete');
    Route::get('/checkout', [CustomerController::class, 'index'])->name('customer.checkout');
    Route::post('/addbook', [CustomerController::class, 'addbook'])->name('customer.addbook');
    Route::get('/checksession', [CustomerController::class, 'checksession'])->name('customer.checksession');
    Route::post('/addtobuku', [CustomerController::class, 'addToBuku'])->name('customer.addtobuku');
    Route::get('/checksession', [CustomerController::class, 'checkSession'])->name('customer.checksession');
    Route::get('/cart', [CustomerController::class, 'formPeminjaman'])->name('customer.form.peminjaman');
    Route::patch('/deletecart', [CustomerController::class, 'deleteFromPeminjaman'])->name('customer.form.delete');
    Route::post('/peminjaman-customer', [CustomerController::class, 'submitForm'])->name('customer.peminjaman');
    Route::get('/daftar-peminjaman', [CustomerController::class, 'getDetailPeminjaman'])->name('customer.daftar.peminjaman');
    Route::get('/detail-peminjaman', [CustomerController::class, 'detail'])->name('customer.detail.peminjaman');
    Route::patch('/update-status-peminjaman', [CustomerController::class, 'updateStatus'])->name('customer.update.peminjaman');
    Route::patch('/update-status-pengembalian', [CustomerController::class, 'kembalikan'])->name('customer.update.pengembalian');
});

// Route::get('/dashboard', function () {
//     return Inertia::render('Dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

// Route::middleware('auth')->group(function () {
//     Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
//     Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
//     Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
// });

// auth
Route::get('/admin-login', [AuthController::class, 'loginAdminIndex'])
    ->name('login-admin');
Route::get('/login', [AuthController::class, 'loginUserIndex'])->name('login');
Route::post('/loginadmin', [AuthController::class, 'loginAdmin'])->name('login.admin');
Route::post('/login-user', [AuthController::class, 'loginPeminjam'])->name('login.peminjam');
Route::get('/register-admin', [AuthController::class, 'registerIndex'])->name('register.admin.index');
Route::post('/register/admin', [AuthController::class, 'registerAdmin'])->name('register.admin');
Route::post('/register/user', [AuthController::class, 'registerPeminjam'])->name('register.peminjam');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
Route::get('/register-user', [AuthController::class, 'registerIndexPeminjam'])->name('user.register');
