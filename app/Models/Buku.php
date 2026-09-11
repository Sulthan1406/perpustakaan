<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Buku extends Model
{
    use HasFactory;

    protected $table = 'bukus';

    protected $fillable = [
        'isbn',
        'nama_buku',
        'stok',
        'foto_buku',
        'kategori_buku_id',
    ];

    // Relasi: Buku milik satu Kategori
    public function kategori()
    {
        return $this->belongsTo(KategoriBuku::class, 'kategori_buku_id');
    }

    // Relasi: Satu Buku dipinjam oleh banyak Member (1 to Many)
    public function members()
    {
        return $this->hasMany(Member::class, 'buku_id');
    }
}