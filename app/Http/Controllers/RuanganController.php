<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Ruangan;
use Auth;

class RuanganController extends Controller
{
    public function index()
    {
        $ruangan = Ruangan::all();
        return view('ruangan.index', compact('ruangan'));
    }
    public function showPinjamForm($id)
    {
        $ruangan = Ruangan::findOrFail($id);
        return view('ruangan.pinjam', compact('ruangan'));
    }
    public function storePinjam(Request $request, $id)
{
    $ruangan = Ruangan::findOrFail($id);
    $ruangan->start_pinjam = $request->start_pinjam;
    $ruangan->end_pinjam = $request->end_pinjam;
    $ruangan->verifikasi = false; // Atur verifikasi menjadi false
    $ruangan->save();

    return redirect()->route('home')->with('status', 'Peminjaman ruangan berhasil diajukan.');
}
    public function create()
    {
        return view('ruangan.create');
    }

    public function store(Request $request)
    {
        Ruangan::create($request->all());
        return redirect()->route('ruangan.index');
    }

    public function edit($id)
    {
        $ruangan = Ruangan::find($id);
        return view('ruangan.edit', compact('ruangan'));
    }

    public function update(Request $request, $id)
    {
        $ruangan = Ruangan::find($id);
        $ruangan->update($request->all());
        return redirect()->route('ruangan.index');
    }

    public function destroy($id)
    {
        Ruangan::find($id)->delete();
        return redirect()->route('ruangan.index');
    }

    public function book($id)
    {
        $ruangan = Ruangan::find($id);
        return view('ruangan.book', compact('ruangan'));
    }

    public function processBooking(Request $request, $id)
    {
        $ruangan = Ruangan::find($id);
        $ruangan->update([
            'start_pinjam' => $request->start_pinjam,
            'end_pinjam' => $request->end_pinjam,
            'verifikasi' => false,
        ]);
        return redirect()->route('ruangan.index');
    }

    public function verify($id)
    {
        $ruangan = Ruangan::find($id);
        $ruangan->update(['verifikasi' => true]);
        return redirect()->route('ruangan.index');
    }
}