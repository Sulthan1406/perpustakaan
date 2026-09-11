@extends('layouts.app')

@section('content')
<div class="container mt-4 mb-5">
    <div class="card shadow-sm border-0">
        <div class="card-body p-4">
            <h3 class="card-title fw-bold mb-4">Tambah Buku Baru</h3>

            <form action="{{ route('buku.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="mb-3">
                    <label for="isbn" class="form-label">ISBN</label>
                    <input type="text" name="isbn" id="isbn" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label for="foto" class="form-label">Foto Sampul Buku</label>
                    <input type="file" name="foto" id="foto" class="form-control" accept="image/*">
                </div>

                <div class="mb-3">
                    <label for="nama_buku" class="form-label">Nama Buku</label>
                    <input type="text" name="nama_buku" id="nama_buku" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label for="stok" class="form-label">Stok</label>
                    <input type="number" name="stok" id="stok" class="form-control" required>
                </div>

                <div class="mb-4">
                    <label for="kategori_id" class="form-label">Kategori Buku</label>
                    <select name="kategori_id" id="kategori_id" class="form-select">
                        <option value="" selected>-- Pilih Kategori --</option>
                        @foreach($kategori as $item)
                            <option value="{{ $item->id }}">{{ $item->nama_kategori }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="d-flex gap-2">
                    <button type="submit" class="btn btn-primary px-3">Simpan Buku</button>
                    <a href="{{ route('buku.index') }}" class="btn btn-secondary px-3">Kembali</a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
