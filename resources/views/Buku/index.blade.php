@extends('layouts.app')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-3">
    <h3>Tampilan Web Buku</h3>
    <a href="{{ route('buku.create') }}" class="btn btn-primary">Tambah Buku</a>
</div>

<div class="table-responsive">
    <table class="table table-bordered bg-white shadow-sm">
        <thead class="table-dark">
            <tr>
                <th>no</th>
                <th>isbn</th>
                <th>foto</th>
                <th>nama_buku</th>
                <th>stok</th>
                <th>kategori_buku</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse($buku as $index => $item)
            <tr>
                <td>{{ $index + 1 }}</td>
                <td>{{ $item->isbn }}</td>
                <td>
                    @if($item->foto_buku)
                        <img src="{{ asset('storage/' . $item->foto_buku) }}" width="60" alt="Foto">
                    @else
                        <span class="text-muted">No Image</span>
                    @endif
                </td>
                <td>{{ $item->nama_buku }}</td>
                <td>
                    <span class="badge {{ $item->stok > 0 ? 'bg-success' : 'bg-danger' }}">
                        {{ $item->stok }}
                    </span>
                </td>
                <td>{{ $item->kategori->nama_kategori ?? '-' }}</td>
                <td>
                    <a href="{{ route('buku.edit', $item->id) }}" class="btn btn-sm btn-warning">Edit</a>
                    <form action="{{ route('buku.destroy', $item->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin hapus?')">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-sm btn-danger">Hapus</button>
                    </form>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="7" class="text-center">Belum ada data buku.</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection