<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Member extends Model
{
    use HasFactory;

    protected $table = 'members';

    protected $fillable = [
        'foto_member',
        'nama_member',
        'jenis_kelamin',
        'tanggal_lahir',
        'no_telepon',
        'email',
        'buku_id',
    ];

    // Relasi: Member meminjam satu Buku
    public function buku()
    {
        return $this->belongsTo(Buku::class, 'buku_id');
    }
}