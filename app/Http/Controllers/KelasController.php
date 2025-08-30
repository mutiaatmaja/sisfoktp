<?php

namespace App\Http\Controllers;

use App\Models\Kelas;
use Illuminate\Http\Request;

class KelasController extends Controller
{
    public function rombel()
    {
        $kelas = \App\Models\Kelas::all();
        return view('kelas.rombel', compact('kelas'));
    }

    public function siswa($id)
    {
        $kelas = \App\Models\Kelas::findOrFail($id);
        $murids = \App\Models\Murid::with('jurusan')->where('kelas_id', $id)->get();
        return view('kelas.siswa', compact('kelas', 'murids'));
    }

    public function cetakPdf($id)
    {
        $kelas = \App\Models\Kelas::findOrFail($id);
        $murids = \App\Models\Murid::with('jurusan')->where('kelas_id', $id)->get();
        $jurusan = null;
        // $pdf = \Barryvdh\DomPDF\Facade\Pdf::setOptions(['isHtml5ParserEnabled' => true, 'isRemoteEnabled' => true])
        //     ->loadView('murid.pdf', compact('murids', 'jurusan', 'kelas'))
        //     ->getDomPDF()
        //     ->setHttpContext(
        //         stream_context_create([
        //             'ssl' => [
        //                 'allow_self_signed' => true,
        //                 'verify_peer' => false,
        //                 'verify_peer_name' => false,
        //             ],
        //         ]),
        //     )
        //     ->setPaper('a4', 'landscape');
        // $filename = 'siswa-kelas-' . $kelas->nama . '.pdf';
        // return $pdf->stream($filename);
        return view('murid.nopdf', compact('murids', 'jurusan', 'kelas'));
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $kelas = \App\Models\Kelas::all();
        return view('kelas.index', compact('kelas'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('kelas.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(\App\Http\Requests\KelasRequest $request)
    {
        \App\Models\Kelas::create($request->validated());
        return redirect()->route('kelas.index')->with('success', 'Kelas berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    // ...existing code...

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Kelas $kelas)
    {
        return view('kelas.edit', compact('kelas'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(\App\Http\Requests\KelasRequest $request, Kelas $kelas)
    {
        $kelas->update($request->validated());
        return redirect()->route('kelas.index')->with('success', 'Kelas berhasil diupdate');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Kelas $kelas)
    {
        $kelas->delete();
        return redirect()->route('kelas.index')->with('success', 'Kelas berhasil dihapus');
    }
}
