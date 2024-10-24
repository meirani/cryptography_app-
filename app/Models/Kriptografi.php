<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Kriptografi extends Model
{
    // Nama tabel di database
    protected $table = 'keyencry';

    // Field yang dapat diisi (mass assignable)
    protected $fillable = [
        'cipher_text', // Menyimpan hasil enkripsi
        'key', // Menyimpan key (password) yang digunakan
    ];

    // Disable timestamps jika tidak ada kolom created_at dan updated_at
    public $timestamps = false;
}
