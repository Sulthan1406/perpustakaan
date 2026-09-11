@extends('layouts.app')

@section('content')
<div class="container mt-4 mb-5">

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

    <div class="card shadow-sm border-0 mb-4">
        <div class="card-body p-4">
            <h3 class="card-title fw-bold mb-4">Form Peminjaman Buku</h3>

            <form action="{{ route('peminjaman.store') }}" method="POST">
                @csrf

                <div class="mb-3">
                    <label for="member_id" class="form-label">Pilih Member</label>
                    <select name="member_id" id="member_id" class="form-select" required>
                        <option value="" selected disabled>-- Pilih Member --</option>
                        @foreach($members as $member)
                            <option value="{{ $member->id }}">{{ $member->nama }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-4">
                    <label for="buku_id" class="form-label">Pilih Buku</label>
                    <select name="buku_id" id="buku_id" class="form-select" required>
                        <option value="" selected disabled>-- Pilih Buku --</option>
                        @foreach($bukus as $buku)
                            <option value="{{ $buku->id }}">{{ $buku->nama_buku }} (Stok: {{ $buku->stok }})</option>
                        @endforeach
                    </select>
                </div>

                <button type="submit" class="btn btn-primary px-4">Pinjam Buku</button>
            </form>
        </div>
    </div>
</div>
@endsection
