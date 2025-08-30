<?php

namespace App\Http\Controllers\ReactNative;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Murid;
use Illuminate\Support\Facades\Storage;

class MuridController extends Controller
{
    // List all murid
    public function index()
    {
        return response()->json(Murid::all());
    }

    // Add murid
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama' => 'required|string',
            'kelas_id' => 'required|integer',
            'jurusan_id' => 'required|integer',
            // Tambahkan validasi lain sesuai kebutuhan
        ]);
        $murid = Murid::create($validated);
        return response()->json($murid, 201);
    }

    // Update murid
    public function update(Request $request, $id)
    {
        $murid = Murid::findOrFail($id);
        $murid->update($request->all());
        return response()->json($murid);
    }

    // Delete murid
    public function destroy($id)
    {
        $murid = Murid::findOrFail($id);
        $murid->delete();
        return response()->json(['message' => 'Murid deleted']);
    }

    // Upload murid photo
    public function uploadPhoto(Request $request, $id)
    {
        $murid = Murid::findOrFail($id);
        if ($request->hasFile('photo')) {
            $path = $request->file('photo')->store('murid_photos', 'public');
            $murid->foto = $path;
            $murid->save();
            return response()->json(['photo_url' => Storage::url($path)]);
        }
        return response()->json(['error' => 'No photo uploaded'], 400);
    }
}
