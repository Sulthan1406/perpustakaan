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
        $bukus = Buku::with('kategori')->get();
        return view('Buku.index', compact('bukus'));
    }

    public function create()
    {
        $kategori = KategoriBuku::all();
        return view('Buku.create', compact('kategori'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'isbn' => 'required',
            'nama_buku' => 'required',
            'stok' => 'required|numeric',
            'kategori_id' => 'nullable',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $data = $request->all();

        if ($request->hasFile('foto')) {
            $data['foto'] = $request->file('foto')->store('buku', 'public');
        }

        Buku::create($data);

        return redirect()->route('buku.index')->with('success', 'Buku berhasil ditambahkan!');
    }

    public function edit(string $id)
    {
        $buku = Buku::findOrFail($id);
        $kategori = KategoriBuku::all();
        return view('Buku.edit', compact('buku', 'kategori'));
    }

    public function update(Request $request, string $id)
    {
        $request->validate([
            'isbn' => 'required',
            'nama_buku' => 'required',
            'stok' => 'required|numeric',
            'kategori_id' => 'nullable',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $buku = Buku::findOrFail($id);
        $data = $request->all();

        if ($request->hasFile('foto')) {
            if ($buku->foto) {
                Storage::disk('public')->delete($buku->foto);
            }
            $data['foto'] = $request->file('foto')->store('buku', 'public');
        }

        $buku->update($data);

        return redirect()->route('buku.index')->with('success', 'Buku berhasil diperbarui!');
    }

    public function destroy(string $id)
    {
        $buku = Buku::findOrFail($id);

        if ($buku->foto) {
            Storage::disk('public')->delete($buku->foto);
        }

        $buku->delete();

        return redirect()->route('buku.index')->with('success', 'Buku berhasil dihapus!');
    }
}
