<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Artikel;
use Illuminate\Support\Facades\Storage;

class ArtikelController extends Controller
{
    public function index()
    {
        $artikels = Artikel::all();

        $artikels->transform(function ($artikel) {
            // Buat URL yang dapat diakses untuk gambar
            $artikel->images = $artikel->images ? Storage::url($artikel->images) : null;
            return $artikel;
        });

        return response()->json($artikels);
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'kategori' => 'required|string|max:255',
            'content' => 'required|string',
            'images' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Validasi file gambar
        ]);

        $data = $request->all();

        // Simpan gambar jika ada
        if ($request->hasFile('images')) {
            $path = $request->file('images')->store('images', 'public'); // Simpan di folder 'public/images'
            $data['images'] = $path;
        }

        $artikel = Artikel::create($data);

        return response()->json([
            'message' => 'Artikel berhasil dibuat',
            'data' => $artikel
        ]);
    }

    public function show($id)
    {
        $artikel = Artikel::find($id);
        if ($artikel) {
            $artikel->images = $artikel->images ? Storage::url($artikel->images) : null;
            return response()->json($artikel);
        } else {
            return response()->json(['message' => 'Artikel not found'], 404);
        }
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'kategori' => 'required|string|max:255',
            'content' => 'required|string',
            'images' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);
    
        $artikel = Artikel::find($id);
    
        if ($artikel) {
            $data = $request->all();
    
            // Update gambar jika ada
            if ($request->hasFile('images')) {
                // Hapus gambar lama jika ada
                if ($artikel->images && Storage::exists($artikel->images)) {
                    Storage::delete($artikel->images);
                }
    
                // Simpan gambar baru
                $path = $request->file('images')->store('images', 'public');
                $data['images'] = $path;
            }
    
            // Update artikel dengan data baru
            $artikel->update($data);
    
            return response()->json(['message' => 'Artikel updated successfully', 'data' => $artikel]);
        } else {
            return response()->json(['message' => 'Artikel not found'], 404);
        }
    }

    public function destroy($id)
    {
        $artikel = Artikel::find($id);
        if ($artikel) {
            // Hapus gambar dari storage jika ada
            if ($artikel->images && Storage::exists($artikel->images)) {
                Storage::delete($artikel->images);
            }

            $artikel->delete();
            return response()->json(['message' => 'Artikel deleted successfully']);
        } else {
            return response()->json(['message' => 'Artikel not found'], 404);
        }
    }
}
