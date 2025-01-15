<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Organisasi;

class OrganisasiController extends Controller
{
    public function index()
    {
        $organisasi = Organisasi::all(); // Mengambil semua data dari tabel organisasi
        return response()->json($organisasi);
    }
}