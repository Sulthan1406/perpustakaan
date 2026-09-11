@extends('layouts.app')

@section('content')
<div class="container mt-4 mb-5">
    <div class="card shadow-sm border-0">
        <div class="card-body p-4">
            <h3 class="card-title fw-bold mb-4">Edit Kategori Buku</h3>

            <form action="{{ route('kategori.update', $kategori->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="mb-4">
                    <label for="nama_kategori" class="form-label">Nama Kategori</label>
                    <input type="text" name="nama_kategori" id="nama_kategori" class="form-control" value="{{ $kategori->nama_kategori }}" required>
                </div>

                <div class="d-flex gap-2">
                    <button type="submit" class="btn btn-primary px-3">Update Kategori</button>
                    <a href="{{ route('kategori.index') }}" class="btn btn-secondary px-3">Kembali</a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
