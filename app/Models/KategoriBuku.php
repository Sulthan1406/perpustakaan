<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KategoriBuku extends Model
{
    use HasFactory;

    protected $table = 'kategori_bukus';

    protected $fillable = [
        'nama_kategori',
    ];

    // Relasi: Satu Kategori memiliki banyak Buku (1 to Many)
    public function bukus()
    {
        return $this->hasMany(Buku::class, 'kategori_buku_id');
    }
}