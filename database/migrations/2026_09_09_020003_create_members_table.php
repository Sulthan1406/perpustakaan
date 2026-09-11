<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
   public function up(): void
{
    Schema::create('members', function (Blueprint $table) {
        $table->id();
        $table->string('foto_member')->nullable();
        $table->string('nama_member');
        $table->enum('jenis_kelamin', ['Pria', 'Wanita']);
        $table->date('tanggal_lahir')->nullable();
        $table->string('no_telepon')->nullable();
        $table->string('email')->unique();
        $table->foreignId('buku_id')->nullable()->constrained('bukus')->onDelete('set null');

        // --- Kolom Tambahan Status ---
        $table->enum('status', ['Masih Dipinjam', 'Sudah Dikembalikan'])->default('Masih Dipinjam');

        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('members');
    }
};
