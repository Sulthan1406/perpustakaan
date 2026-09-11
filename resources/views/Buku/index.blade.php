@extends('layouts.app')

@section('content')
<div class="container mt-4 mb-5">

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="d-flex justify-content-between align-items-center mb-4">
        <h3 class="fw-bold mb-0">Tampilan Web Buku</h3>
        <a href="{{ route('buku.create') }}" class="btn btn-primary px-3">+ Tambah Buku</a>
    </div>

    <div class="card shadow-sm border-0">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="table-dark">
                        <tr>
                            <th class="ps-3">No</th>
                            <th>ISBN</th>
                            <th>Foto</th>
                            <th>Nama Buku</th>
                            <th>Stok</th>
                            <th>Kategori Buku</th>
                            <th class="pe-3 text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($bukus as $index => $item)
                            <tr>
                                <td class="ps-3">{{ $index + 1 }}</td>
                                <td>{{ $item->isbn }}</td>
                                <td>
                                    @if($item->foto)
                                        <img src="{{ asset('storage/' . $item->foto) }}" width="50" alt="foto buku">
                                    @else
                                        -
                                    @endif
                                </td>
                                <td class="fw-semibold">{{ $item->nama_buku }}</td>
                                <td>{{ $item->stok }}</td>
                                <td>
                                    @if($item->kategori_id && optional($item->kategori)->nama_kategori !== 'Tidak Ada Kategori')
                                        <span class="badge bg-info text-dark">{{ $item->kategori->nama_kategori }}</span>
                                    @else
                                        <span class="badge bg-secondary">Tidak Ada Kategori</span>
                                    @endif
                                </td>
                                <td class="pe-3 text-center">
                                    <div class="d-flex justify-content-center gap-2">
                                        <a href="{{ route('buku.edit', $item->id) }}" class="btn btn-sm btn-outline-warning">Edit</a>
                                        <form action="{{ route('buku.destroy', $item->id) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-outline-danger" onclick="return confirm('Yakin hapus buku ini?')">Hapus</button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="text-center py-4 text-muted">Belum ada data buku.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
