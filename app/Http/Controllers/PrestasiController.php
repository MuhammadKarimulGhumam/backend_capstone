<?php

namespace App\Http\Controllers;

use App\Models\Prestasi;
use Illuminate\Http\Request;

class PrestasiController extends Controller
{
    public function index()
    {
        $prestasi = Prestasi::all(); // Mengambil semua data dari tabel prestasi
        return response()->json($prestasi);
    }
}