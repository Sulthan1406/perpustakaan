<?php

namespace App\Http\Controllers;

use App\Models\Buku;
use App\Models\Member;
use Illuminate\Http\Request;

class PeminjamanController extends Controller
{
    public function pinjamBuku(Request $request)
    {
        $request->validate([
            'member_id' => 'required|exists:members,id',
            'buku_id' => 'required|exists:bukus,id',
        ]);

        $buku = Buku::findOrFail($request->buku_id);

        // Cek jika stok <= 0 (Sesuai catatan papan tulis)
        if ($buku->stok <= 0) {
            return back()->with('error', 'Buku tidak bisa dipinjam karena stok habis!');
        }

        $member = Member::findOrFail($request->member_id);

        $member->buku_id = $buku->id;
        $member->save();

        // Kurangi stok buku
        $buku->decrement('stok');

        return back()->with('success', 'Buku berhasil dipinjam!');
    }

    public function kembalikanBuku(Request $request, Member $member)
    {
        if ($member->buku_id) {
            $buku = Buku::find($member->buku_id);
            if ($buku) {
                $buku->increment('stok');
            }

            $member->buku_id = null;
            $member->save();

            return back()->with('success', 'Buku berhasil dikembalikan!');
        }

        return back()->with('error', 'Member ini sedang tidak meminjam buku!');
    }
}
