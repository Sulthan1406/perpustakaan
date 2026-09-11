@extends('layouts.app')

@section('content')
<div class="card p-4 shadow-sm bg-white">
    <h3>Tambah Buku</h3>
    <form action="{{ route('buku.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="mb-3">
            <label class="form-label">ISBN</label>
            <input type="text" name="isbn" class="form-control" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Nama Buku</label>
            <input type="text" name="nama_buku" class="form-control" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Stok</label>
            <input type="number" name="stok" class="form-control" min="0" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Kategori Buku</label>
            <select name="kategori_buku_id" class="form-select" required>
                <option value="">-- Pilih Kategori --</option>
                @foreach($kategori as $kat)
                    <option value="{{ $kat->id }}">{{ $kat->nama_kategori }}</option>
                @endforeach
            </select>
        </div>
        <div class="mb-3">
            <label class="form-label">Foto Buku</label>
            <input type="file" name="foto_buku" class="form-control">
        </div>
        <button type="submit" class="btn btn-success">Simpan Buku</button>
        <a href="{{ route('buku.index') }}" class="btn btn-secondary">Kembali</a>
    </form>
</div>
@endsection