@extends('layouts.app')

@section('content')
<div class="card p-4 shadow-sm bg-white">
    <h3>Edit Buku</h3>
    <form action="{{ route('buku.update', $buku->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label class="form-label">ISBN</label>
            <input type="text" name="isbn" class="form-control" value="{{ old('isbn', $buku->isbn) }}" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Nama Buku</label>
            <input type="text" name="nama_buku" class="form-control" value="{{ old('nama_buku', $buku->nama_buku) }}" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Stok</label>
            <input type="number" name="stok" class="form-control" min="0" value="{{ old('stok', $buku->stok) }}" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Kategori Buku</label>
            <select name="kategori_buku_id" class="form-select" required>
                <option value="">-- Pilih Kategori --</option>
                @foreach($kategori as $kat)
                    <option value="{{ $kat->id }}" {{ $buku->kategori_buku_id == $kat->id ? 'selected' : '' }}>
                        {{ $kat->nama_kategori }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label class="form-label">Foto Buku</label>
            @if($buku->foto_buku)
                <div class="mb-2">
                    <img src="{{ asset('storage/' . $buku->foto_buku) }}" width="100" class="img-thumbnail" alt="Foto Buku">
                </div>
            @endif
            <input type="file" name="foto_buku" class="form-control">
            <small class="text-muted">Biarkan kosong jika tidak ingin mengubah foto.</small>
        </div>

        <button type="submit" class="btn btn-warning">Update Buku</button>
        <a href="{{ route('buku.index') }}" class="btn btn-secondary">Batal</a>
    </form>
</div>
@endsection