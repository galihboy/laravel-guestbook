<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Guestbook;

class GuestbookController extends Controller
{
    public function index()
    {
        $guestbooks = Guestbook::orderBy('created_at', 'desc')->get();
        return view('guestbook.index', compact('guestbooks'));
    }

    public function store(Request $request)
    {
        \Log::info('Mencoba menyimpan data buku tamu', $request->all());

        $request->validate([
            'nama' => 'required|max:255',
            'email' => 'nullable|email|max:255',
            'pesan' => 'required'
        ]);

        Guestbook::create($request->all());

        return back()->with('success', 'Pesan berhasil ditambahkan!');
    }
}
