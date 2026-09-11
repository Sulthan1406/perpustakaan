<?php

namespace App\Http\Controllers;

use App\Models\Member;
use App\Models\Buku;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class MemberController extends Controller
{
    public function index()
    {
        $members = Member::with('buku')->get();
        return view('member.index', compact('members'));
    }

    public function create()
    {
        return view('member.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_member' => 'required|string|max:255',
            'jenis_kelamin' => 'required|in:Pria,Wanita',
            'tanggal_lahir' => 'nullable|date',
            'no_telepon' => 'nullable|string|max:20',
            'email' => 'required|email|unique:members,email',
            'foto_member' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $fotoPath = null;
        if ($request->hasFile('foto_member')) {
            $fotoPath = $request->file('foto_member')->store('foto_member', 'public');
        }

        Member::create([
            'foto_member' => $fotoPath,
            'nama_member' => $request->nama_member,
            'jenis_kelamin' => $request->jenis_kelamin,
            'tanggal_lahir' => $request->tanggal_lahir,
            'no_telepon' => $request->no_telepon,
            'email' => $request->email,
        ]);

        return redirect()->route('member.index')->with('success', 'Member berhasil ditambahkan!');
    }

    public function edit(Member $member)
    {
        return view('member.edit', compact('member'));
    }

    public function update(Request $request, Member $member)
    {
        $request->validate([
            'nama_member' => 'required|string|max:255',
            'jenis_kelamin' => 'required|in:Pria,Wanita',
            'tanggal_lahir' => 'nullable|date',
            'no_telepon' => 'nullable|string|max:20',
            'email' => 'required|email|unique:members,email,' . $member->id,
            'foto_member' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $fotoPath = $member->foto_member;
        if ($request->hasFile('foto_member')) {
            if ($member->foto_member && Storage::disk('public')->exists($member->foto_member)) {
                Storage::disk('public')->delete($member->foto_member);
            }
            $fotoPath = $request->file('foto_member')->store('foto_member', 'public');
        }

        $member->update([
            'foto_member' => $fotoPath,
            'nama_member' => $request->nama_member,
            'jenis_kelamin' => $request->jenis_kelamin,
            'tanggal_lahir' => $request->tanggal_lahir,
            'no_telepon' => $request->no_telepon,
            'email' => $request->email,
        ]);

        return redirect()->route('member.index')->with('success', 'Member berhasil diperbarui!');
    }

    public function destroy(Member $member)
    {
        if ($member->foto_member && Storage::disk('public')->exists($member->foto_member)) {
            Storage::disk('public')->delete($member->foto_member);
        }

        $member->delete();
        return redirect()->route('member.index')->with('success', 'Member berhasil dihapus!');
    }
}