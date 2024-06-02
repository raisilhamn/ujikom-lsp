<?php

namespace App\Http\Controllers;

use Inertia\Inertia;

class landingController extends Controller
{
    public function index()
    {
        $buku = \App\Models\Buku::take(5)->get();

        // inertia
        return Inertia::render('Landing', [
            'buku' => $buku,
        ]);
    }
}
