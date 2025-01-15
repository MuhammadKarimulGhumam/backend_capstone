<?php

namespace App\Http\Controllers;

use App\Models\Video;
use Illuminate\Http\Request;

class VideoController extends Controller
{
    // Menampilkan semua video
    public function index()
    {
        $videos = Video::all();
        return response()->json($videos);
    }

    // Menyimpan video baru
    public function store(Request $request)
    {
        $request->validate([
            'judul' => 'required|string|max:255',
            'videoUrl' => 'required|url', // Validasi URL
            'description' => 'required|string',
        ]);

        $video = Video::create([
            'judul' => $request->judul,
            'videoUrl' => $request->videoUrl,
            'description' => $request->description,
        ]);

        return response()->json($video, 201);
    }

    // Menampilkan video berdasarkan ID
    public function show($id)
    {
        $video = Video::findOrFail($id);
        return response()->json($video);
    }

    // Mengupdate video
    public function update(Request $request, $id)
    {
        $video = Video::findOrFail($id);

        $request->validate([
            'judul' => 'required|string|max:255',
            'videoUrl' => 'nullable|url',
            'description' => 'required|string',
        ]);

        $video->judul = $request->judul;
        $video->videoUrl = $request->videoUrl ?: $video->videoUrl;
        $video->description = $request->description;
        $video->save();

        return response()->json($video);
    }

    // Menghapus video
    public function destroy($id)
    {
        $video = Video::findOrFail($id);
        $video->delete();

        return response()->json(['message' => 'Video deleted successfully']);
    }
}
