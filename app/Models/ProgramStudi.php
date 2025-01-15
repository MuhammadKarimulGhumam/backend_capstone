<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProgramStudi extends Model
{
    use HasFactory;

    protected $table = 'programstudi'; // tentukan nama tabel
    protected $fillable = ['content']; // kolom yang dapat diisi
}