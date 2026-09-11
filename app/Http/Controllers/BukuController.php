<?php

namespace App\Http\Controllers;

use App\Models\Buku;
use App\Models\KategoriBuku;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class BukuController extends Controller
{
    public function index()
    {
        $buku = Buku::with('kategori')->get();
        return view('buku.index', compact('buku'));
    }

    public function create()
    {
        $kategori = KategoriBuku::all();
        return view('buku.create', compact('kategori'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'isbn' => 'required|unique:bukus,isbn',
            'nama_buku' => 'required|string|max:255',
            'stok' => 'required|integer|min:0',
            'foto_buku' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'kategori_buku_id' => 'required|exists:kategori_bukus,id',
        ]);

        $fotoPath = null;
        if ($request->hasFile('foto_buku')) {
            $fotoPath = $request->file('foto_buku')->store('foto_buku', 'public');
        }

        Buku::create([
            'isbn' => $request->isbn,
            'nama_buku' => $request->nama_buku,
            'stok' => $request->stok,
            'foto_buku' => $fotoPath,
            'kategori_buku_id' => $request->kategori_buku_id,
        ]);

        return redirect()->route('buku.index')->with('success', 'Buku berhasil ditambahkan!');
    }

    public function edit(Buku $buku)
    {
        $kategori = KategoriBuku::all();
        return view('buku.edit', compact('buku', 'kategori'));
    }

    public function update(Request $request, Buku $buku)
    {
        $request->validate([
            'isbn' => 'required|unique:bukus,isbn,' . $buku->id,
            'nama_buku' => 'required|string|max:255',
            'stok' => 'required|integer|min:0',
            'foto_buku' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'kategori_buku_id' => 'required|exists:kategori_bukus,id',
        ]);

        $fotoPath = $buku->foto_buku;
        if ($request->hasFile('foto_buku')) {
            if ($buku->foto_buku && Storage::disk('public')->exists($buku->foto_buku)) {
                Storage::disk('public')->delete($buku->foto_buku);
            }
            $fotoPath = $request->file('foto_buku')->store('foto_buku', 'public');
        }

        $buku->update([
            'isbn' => $request->isbn,
            'nama_buku' => $request->nama_buku,
            'stok' => $request->stok,
            'foto_buku' => $fotoPath,
            'kategori_buku_id' => $request->kategori_buku_id,
        ]);

        return redirect()->route('buku.index')->with('success', 'Buku berhasil diperbarui!');
    }

    public function destroy(Buku $buku)
    {
        if ($buku->foto_buku && Storage::disk('public')->exists($buku->foto_buku)) {
            Storage::disk('public')->delete($buku->foto_buku);
        }

        $buku->delete();
        return redirect()->route('buku.index')->with('success', 'Buku berhasil dihapus!');
    }
}