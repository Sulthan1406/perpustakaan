@extends('layouts.app')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-3">
    <h3>Daftar Kategori Buku</h3>
    <a href="{{ route('kategori.create') }}" class="btn btn-primary">Tambah Kategori</a>
</div>

<div class="table-responsive">
    <table class="table table-bordered bg-white shadow-sm">
        <thead class="table-dark">
            <tr>
                <th width="80">no</th>
                <th>nama_kategori</th>
                <th width="180">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse($kategori as $index => $item)
            <tr>
                <td>{{ $index + 1 }}</td>
                <td>{{ $item->nama_kategori }}</td>
                <td>
                    <a href="{{ route('kategori.edit', $item->id) }}" class="btn btn-sm btn-warning">Edit</a>
                    <form action="{{ route('kategori.destroy', $item->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin hapus kategori ini?')">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-sm btn-danger">Hapus</button>
                    </form>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="3" class="text-center">Belum ada data kategori. Silahkan tambah kategori baru.</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection