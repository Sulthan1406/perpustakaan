@extends('layouts.app')

@section('content')
<div class="container mt-4 mb-5">

    {{-- Alert Notifikasi --}}
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    {{-- Header Judul & Tombol Tambah --}}
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h3 class="fw-bold mb-0">Data Member & Peminjaman</h3>
        <a href="{{ route('member.create') }}" class="btn btn-primary px-3">+ Tambah Peminjam</a>
    </div>

    {{-- Tabel Member --}}
    <div class="card shadow-sm border-0">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="table-dark">
                        <tr>
                            <th class="ps-3">No</th>
                            <th>Nama</th>
                            <th>No Telepon</th>
                            <th>Email</th>
                            <th>Buku Dipinjam</th>
                            <th>Status</th>
                            <th class="pe-3 text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($members as $index => $item)
                            <tr>
                                <td class="ps-3">{{ $index + 1 }}</td>
                                <td class="fw-semibold">{{ $item->nama_member }}</td>
                                <td>{{ $item->no_telepon ?? '-' }}</td>
                                <td>{{ $item->email }}</td>
                                <td>
                                    @if($item->buku)
                                        <span class="badge bg-info text-dark">{{ $item->buku->nama_buku }}</span>
                                    @else
                                        <span class="text-muted">-</span>
                                    @endif
                                </td>
                                <td>
                                    @if($item->status === 'Masih Dipinjam')
                                        <span class="badge bg-warning text-dark">Masih Dipinjam</span>
                                    @else
                                        <span class="badge bg-success">Sudah Dikembalikan</span>
                                    @endif
                                </td>
                                <td class="pe-3 text-center">
                                    <div class="d-flex justify-content-center gap-2">
                                        @if($item->status === 'Masih Dipinjam' && $item->buku_id)
                                            <form action="{{ route('member.kembalikan', $item->id) }}" method="POST">
                                                @csrf
                                                <button type="submit" class="btn btn-sm btn-outline-success" onclick="return confirm('Apakah buku ini sudah dikembalikan?')">
                                                    Kembalikan Buku
                                                </button>
                                            </form>
                                        @endif

                                        <form action="{{ route('member.destroy', $item->id) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-outline-danger" onclick="return confirm('Yakin ingin menghapus data ini?')">
                                                Hapus
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="text-center py-4 text-muted">Belum ada data peminjam.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
