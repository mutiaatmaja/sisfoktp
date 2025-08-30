<?php

namespace App\Http\Controllers;

use App\Models\Jurusan;
use Illuminate\Http\Request;

class JurusanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $jurusans = \App\Models\Jurusan::all();
        return view('jurusan.index', compact('jurusans'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('jurusan.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(\App\Http\Requests\JurusanRequest $request)
    {
        \App\Models\Jurusan::create($request->validated());
        return redirect()->route('jurusan.index')->with('success', 'Jurusan berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    // ...existing code...

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Jurusan $jurusan)
    {
        return view('jurusan.edit', compact('jurusan'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(\App\Http\Requests\JurusanRequest $request, Jurusan $jurusan)
    {
        $jurusan->update($request->validated());
        return redirect()->route('jurusan.index')->with('success', 'Jurusan berhasil diupdate');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Jurusan $jurusan)
    {
        $jurusan->delete();
        return redirect()->route('jurusan.index')->with('success', 'Jurusan berhasil dihapus');
    }
}
