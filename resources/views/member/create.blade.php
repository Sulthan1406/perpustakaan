@extends('layouts.app')

@section('content')
<div class="container mt-4 mb-5">
    <div class="card shadow-sm border-0">
        <div class="card-body p-4">
            <h3 class="card-title fw-bold mb-4">Tambah Data Peminjam</h3>

            <form action="{{ route('member.store') }}" method="POST">
                @csrf

                <!-- Nama Member -->
                <div class="mb-3">
                    <label for="nama_member" class="form-label">Nama Peminjam</label>
                    <input type="text" name="nama_member" id="nama_member" class="form-control" placeholder="Masukkan nama peminjam" required>
                </div>

                <!-- Jenis Kelamin -->
                <div class="mb-3">
                    <label for="jenis_kelamin" class="form-label">Jenis Kelamin</label>
                    <select name="jenis_kelamin" id="jenis_kelamin" class="form-select" required>
                        <option value="" selected disabled>-- Pilih Jenis Kelamin --</option>
                        <option value="Pria">Pria</option>
                        <option value="Wanita">Wanita</option>
                    </select>
                </div>

                <!-- Tanggal Lahir -->
                <div class="mb-3">
                    <label for="tanggal_lahir" class="form-label">Tanggal Lahir</label>
                    <input type="date" name="tanggal_lahir" id="tanggal_lahir" class="form-control">
                </div>

                <!-- No Telepon -->
                <div class="mb-3">
                    <label for="no_telepon" class="form-label">No Telepon Peminjam</label>
                    <input type="text" name="no_telepon" id="no_telepon" class="form-control" placeholder="Masukkan nomor telepon">
                </div>

                <!-- Email Peminjam -->
                <div class="mb-3">
                    <label for="email" class="form-label">Email Peminjam</label>
                    <input type="email" name="email" id="email" class="form-control" placeholder="Masukkan email peminjam" required>
                </div>

                <!-- Select Buku (Dipinjam) -->
                <div class="mb-4">
                    <label for="buku_id" class="form-label">Buku Dipinjam (Opsional)</label>
                    <select name="buku_id" id="buku_id" class="form-select">
                        <option value="" selected>-- Tidak Pinjam Buku --</option>
                        @foreach($bukus as $buku)
                            <option value="{{ $buku->id }}">{{ $buku->nama_buku }} (Stok: {{ $buku->stok }})</option>
                        @endforeach
                    </select>
                </div>

                <!-- Tombol Action -->
                <div class="d-flex gap-2">
                    <button type="submit" class="btn btn-success px-3">Simpan Data</button>
                    <a href="{{ route('member.index') }}" class="btn btn-secondary px-3">Kembali</a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
