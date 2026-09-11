<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('bukus', function (Blueprint $table) {
            $table->id();
            $table->string('isbn');
            $table->string('foto')->nullable();
            $table->string('nama_buku');
            $table->integer('stok');

            // PERBAIKAN: constrained diarahkan ke 'kategori_bukus'
            $table->foreignId('kategori_id')->nullable()->constrained('kategori_bukus')->onDelete('set null');

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('bukus');
    }
};
