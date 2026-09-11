<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Kategori Buku - Perpustakaan Web</title>
    <!-- CSS Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

    <!-- Navbar Atas -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container">
            <a class="navbar-brand fw-bold" href="#">Perpustakaan Web</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link text-white-50" href="{{ route('buku.index') }}">Data Buku</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-white" href="{{ route('kategori.index') }}">Kategori Buku</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-white-50" href="#">Data Member & Peminjaman</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Content / Form Tambah Kategori -->
    <div class="container mt-4 mb-5">
        <div class="card shadow-sm border-0">
            <div class="card-body p-4">
                <h3 class="card-title fw-bold mb-4">Tambah Kategori Buku</h3>

                <form action="{{ route('kategori.store') }}" method="POST">
                    @csrf

                    <!-- Input Nama Kategori -->
                    <div class="mb-4">
                        <label for="nama_kategori" class="form-label">Nama Kategori</label>
                        <input type="text" name="nama_kategori" id="nama_kategori" class="form-control" placeholder="Masukkan nama kategori" required>
                    </div>

                    <!-- Tombol Action -->
                    <div class="d-flex gap-2">
                        <button type="submit" class="btn btn-success px-3">Simpan Kategori</button>
                        <a href="{{ route('kategori.index') }}" class="btn btn-secondary px-3">Kembali</a>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- JS Bootstrap -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
