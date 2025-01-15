<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Video extends Model
{
    use HasFactory;

    // Tentukan nama tabel jika tidak mengikuti konvensi plural
    protected $table = 'video'; 

    // Tentukan kolom yang bisa diisi secara massal
    protected $fillable = ['judul', 'videoUrl', 'description'];

    // Jika Anda menggunakan timestamps (created_at, updated_at), pastikan properti ini ada
    public $timestamps = true;
}