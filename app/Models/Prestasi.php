<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Prestasi extends Model
{
    use HasFactory;

    // Tentukan nama tabel jika tidak mengikuti konvensi plural
    protected $table = 'prestasi'; 

    // Tentukan kolom yang bisa diisi secara massal
    protected $fillable = ['content'];

    // Jika Anda menggunakan timestamps (created_at, updated_at), pastikan properti ini ada
    public $timestamps = true;
}