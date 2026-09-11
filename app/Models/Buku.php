<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Buku extends Model
{
    use HasFactory;

    protected $fillable = [
        'isbn',
        'foto',
        'nama_buku',
        'stok',
        'kategori_id',
    ];

    public function kategori()
    {
        return $this->belongsTo(KategoriBuku::class, 'kategori_id')->withDefault([
            'nama_kategori' => 'Tidak Ada Kategori'
        ]);
    }
}
