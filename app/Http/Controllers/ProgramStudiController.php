<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ProgramStudi;

class ProgramStudiController extends Controller
{
    public function index()
    {
        $programstudi = ProgramStudi::all(); // Mengambil semua data dari tabel programstudi
        return response()->json($programstudi);
    }
}