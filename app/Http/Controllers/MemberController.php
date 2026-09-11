<?php

namespace App\Http\Controllers;

use App\Models\Buku;
use App\Models\Member;
use Illuminate\Http\Request;

class MemberController extends Controller
{
    public function index()
    {
        $members = Member::with('buku')->get();
        return view('member.index', compact('members'));
    }

    public function create()
    {
        $bukus = Buku::where('stok', '>', 0)->get();
        return view('member.create', compact('bukus'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_member'   => 'required|string|max:255',
            'jenis_kelamin' => 'required|in:Pria,Wanita',
            'tanggal_lahir' => 'nullable|date',
            'no_telepon'    => 'nullable|string|max:20',
            'email'         => 'required|email|max:255|unique:members,email',
            'buku_id'       => 'nullable|exists:bukus,id',
        ]);

        // Jika memilih buku, status otomatis 'Masih Dipinjam'
        $status = $request->buku_id ? 'Masih Dipinjam' : 'Sudah Dikembalikan';

        Member::create([
            'nama_member'   => $request->nama_member,
            'jenis_kelamin' => $request->jenis_kelamin,
            'tanggal_lahir' => $request->tanggal_lahir,
            'no_telepon'    => $request->no_telepon,
            'email'         => $request->email,
            'buku_id'       => $request->buku_id,
            'status'        => $status,
        ]);

        // Kurangi stok jika meminjam buku
        if ($request->buku_id) {
            $buku = Buku::findOrFail($request->buku_id);
            $buku->decrement('stok');
        }

        return redirect()->route('member.index')->with('success', 'Data Peminjam berhasil disimpan!');
    }

    // Method untuk Mengembalikan Buku & Menambah Stok
    public function kembalikanBuku(string $id)
    {
        $member = Member::findOrFail($id);

        if ($member->status === 'Masih Dipinjam' && $member->buku_id) {
            // Tambahkan 1 ke stok buku
            $buku = Buku::findOrFail($member->buku_id);
            $buku->increment('stok');

            // Ubah status peminjaman
            $member->update([
                'status' => 'Sudah Dikembalikan'
            ]);

            return redirect()->route('member.index')->with('success', 'Buku berhasil dikembalikan dan stok buku bertambah!');
        }

        return redirect()->route('member.index')->with('error', 'Status peminjaman tidak dapat diubah.');
    }

    public function destroy(string $id)
    {
        $member = Member::findOrFail($id);

        // Jika member dihapus tapi status masih dipinjam, kembalikan stok buku
        if ($member->status === 'Masih Dipinjam' && $member->buku_id) {
            $buku = Buku::find($member->buku_id);
            if ($buku) {
                $buku->increment('stok');
            }
        }

        $member->delete();

        return redirect()->route('member.index')->with('success', 'Data peminjam berhasil dihapus!');
    }
}
