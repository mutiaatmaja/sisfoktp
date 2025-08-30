<?php

namespace App\Http\Controllers;

use App\Models\Murid;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class MuridController extends Controller
{
    /**
     * Simpan foto murid dari kamera (base64)
     */
    public function updateFotoCamera(Request $request, Murid $murid)
    {
        $request->validate([
            'foto_camera' => 'required|string',
        ]);
        $base64 = $request->foto_camera;
        if (preg_match('/^data:image\/(png|jpeg|jpg);base64,/', $base64)) {
            $base64 = substr($base64, strpos($base64, ',') + 1);
            $base64 = base64_decode($base64);
            $filename = $murid->uuid . '.png';
            $path = storage_path('app/public/foto-murid/' . $filename);
            file_put_contents($path, $base64);
            $murid->foto = $filename;
            $murid->save();
            return response()->json(['success' => true, 'foto' => $filename]);
        }
        return response()->json(['success' => false, 'message' => 'Format foto tidak valid'], 400);
    }
    // ...existing code...
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $murids = \App\Models\Murid::with(['kelas', 'jurusan'])->get();
        return view('murid.index', compact('murids'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $kelas = \App\Models\Kelas::all();
        $jurusan = \App\Models\Jurusan::all();
        return view('murid.create', compact('kelas', 'jurusan'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(\App\Http\Requests\MuridRequest $request)
    {
        $data = $request->validated();
        $data['uuid'] = Str::uuid();
        if ($request->hasFile('foto')) {
            $foto = $request->file('foto');
            $fotoName = $data['uuid'] . '.' . $foto->getClientOriginalExtension();
            $fotoPath = $foto->storeAs('public/foto-murid', $fotoName);
            $backupName = $data['nisn'] . '-' . $data['uuid'] . '.' . $foto->getClientOriginalExtension();
            $foto->storeAs('public/backup-foto-murid', $backupName);
            $data['foto'] = $fotoName;
        }
        \App\Models\Murid::create($data);
        return redirect()->route('murid.index')->with('success', 'Murid berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show(Murid $murid)
    {
        $murid->load(['kelas', 'jurusan']);
        return view('murid.show', compact('murid'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Murid $murid)
    {
        $kelas = \App\Models\Kelas::all();
        $jurusan = \App\Models\Jurusan::all();
        return view('murid.edit', compact('murid', 'kelas', 'jurusan'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(\App\Http\Requests\MuridRequest $request, Murid $murid)
    {
        $data = $request->validated();
        if ($request->hasFile('foto')) {
            $foto = $request->file('foto');
            $fotoName = $murid->uuid . '.' . $foto->getClientOriginalExtension();
            $fotoPath = $foto->storeAs('public/foto-murid', $fotoName);
            $backupName = $data['nisn'] . '-' . $murid->uuid . '.' . $foto->getClientOriginalExtension();
            $foto->storeAs('public/backup-foto-murid', $backupName);
            $data['foto'] = $fotoName;
        }
        // Jika ada input foto_camera (base64), simpan ke storage
        if ($request->filled('foto_camera')) {
            $base64 = $request->foto_camera;
            if (preg_match('/^data:image\/(png|jpeg|jpg);base64,/', $base64)) {
                $base64 = substr($base64, strpos($base64, ',') + 1);
                $base64 = base64_decode($base64);
                $fotoName = $murid->uuid . '.png';
                $path = storage_path('app/public/public/foto-murid/' . $fotoName);
                file_put_contents($path, $base64);
                $data['foto'] = $fotoName;
            }
        }
        $murid->update($data);
        return redirect()->route('murid.index')->with('success', 'Murid berhasil diupdate');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Murid $murid)
    {
        $murid->delete();
        return redirect()->route('murid.index')->with('success', 'Murid berhasil dihapus');
    }

    /**
     * Import murid dari file Excel
     */
    public function importExcel(Request $request)
    {
        $request->validate([
            'file' => 'required|file|mimes:xlsx,xls',
        ]);
        \Maatwebsite\Excel\Facades\Excel::import(new \App\Imports\MuridImport, $request->file('file'));
        return response()->json(['message' => 'Import murid berhasil']);
    }
    /**
     * Cetak PDF data murid
     */
    public function cetakPdf()
    {
        $murids = \App\Models\Murid::with(['kelas', 'jurusan'])->get();
        $jurusan = null;
        $pdf = \Barryvdh\DomPDF\Facade\Pdf::setOptions(['isHtml5ParserEnabled' => true, 'isRemoteEnabled' => true])
            ->loadView('murid.pdf', compact('murids', 'jurusan'))
            ->setPaper('a4', 'landscape');
        return $pdf->stream('data-murid.pdf');
    }
    /**
     * Cetak PDF murid berdasarkan jurusan
     */
    public function cetakPdfJurusan($jurusan_id)
    {
        $murids = \App\Models\Murid::with(['kelas', 'jurusan'])->where('jurusan_id', $jurusan_id)->get();
        $jurusan = \App\Models\Jurusan::find($jurusan_id);
        // $pdf = \Barryvdh\DomPDF\Facade\Pdf::setOptions(['isHtml5ParserEnabled' => true, 'isRemoteEnabled' => true])
        //     ->loadView('murid.pdf', compact('murids', 'jurusan'))
        //     ->getDomPDF()
        //     ->setHttpContext(
        //     stream_context_create([
        //         'ssl' => [
        //             'allow_self_signed' => TRUE,
        //             'verify_peer' => FALSE,
        //             'verify_peer_name' => FALSE,
        //         ]
        //     ])
        //     )
        //     ->setPaper('a4', 'landscape');
        // $filename = 'murid-jurusan-' . ($jurusan ? $jurusan->kode : 'unknown') . '.pdf';
        // return $pdf->stream($filename);
        return view('murid.nopdf', compact('murids', 'jurusan'));
    }
}
