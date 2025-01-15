<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Jadwal;

class JadwalController extends Controller
{
    public function index()
    {
        $jadwal = Jadwal::all();
        return response()->json($jadwal);
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_kegiatan' => 'required|string|max:255',
            'hari' => 'required|string|max:255',
            'jam' => 'required',
            'tempat' => 'required|string|max:255',
        ]);

        $jadwal = Jadwal::create($request->all());

        return response()->json(['message' => 'Jadwal created successfully', 'data' => $jadwal]);
    }

    public function show($id)
    {
        $jadwal = Jadwal::find($id);

        if ($jadwal) {
            return response()->json($jadwal);
        } else {
            return response()->json(['message' => 'Jadwal not found'], 404);
        }
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_kegiatan' => 'required|string|max:255',
            'hari' => 'required|string|max:255',
            'jam' => 'required',
            'tempat' => 'required|string|max:255',
        ]);

        $jadwal = Jadwal::find($id);

        if ($jadwal) {
            $jadwal->update($request->all());
            return response()->json(['message' => 'Jadwal updated successfully', 'data' => $jadwal]);
        } else {
            return response()->json(['message' => 'Jadwal not found'], 404);
        }
    }

    public function destroy($id)
    {
        $jadwal = Jadwal::find($id);

        if ($jadwal) {
            $jadwal->delete();
            return response()->json(['message' => 'Jadwal deleted successfully']);
        } else {
            return response()->json(['message' => 'Jadwal not found'], 404);
        }
    }
}
