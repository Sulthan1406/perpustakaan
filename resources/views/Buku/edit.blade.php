@extends('layouts.app')

@section('content')
<div class="container mt-4 mb-5">
    <div class="card shadow-sm border-0">
        <div class="card-body p-4">
            <h3 class="card-title fw-bold mb-4">Edit Data Buku</h3>

            <form action="{{ route('buku.update', $buku->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label for="isbn" class="form-label">ISBN</label>
                    <input type="text" name="isbn" id="isbn" class="form-control" value="{{ $buku->isbn }}" required>
                </div>

                <div class="mb-3">
                    <label for="foto" class="form-label">Foto Sampul Buku</label>
                    @if($buku->foto)
                        <div class="mb-2">
                            <img src="{{ asset('storage/' . $buku->foto) }}" width="80" class="img-thumbnail" alt="Foto Saat Ini">
                        </div>
                    @endif
                    <input type="file" name="foto" id="foto" class="form-control" accept="image/*">
                    <small class="text-muted">Biarkan kosong jika tidak ingin mengubah foto</small>
                </div>

                <div class="mb-3">
                    <label for="nama_buku" class="form-label">Nama Buku</label>
                    <input type="text" name="nama_buku" id="nama_buku" class="form-control" value="{{ $buku->nama_buku }}" required>
                </div>

                <div class="mb-3">
                    <label for="stok" class="form-label">Stok</label>
                    <input type="number" name="stok" id="stok" class="form-control" value="{{ $buku->stok }}" required>
                </div>

                <div class="mb-4">
                    <label for="kategori_id" class="form-label">Kategori Buku</label>
                    <select name="kategori_id" id="kategori_id" class="form-select">
                        <option value="">-- Pilih Kategori --</option>
                        @foreach($kategori as $item)
                            <option value="{{ $item->id }}" {{ $buku->kategori_id == $item->id ? 'selected' : '' }}>
                                {{ $item->nama_kategori }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="d-flex gap-2">
                    <button type="submit" class="btn btn-primary px-3">Update Buku</button>
                    <a href="{{ route('buku.index') }}" class="btn btn-secondary px-3">Kembali</a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
