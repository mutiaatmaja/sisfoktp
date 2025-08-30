@extends('layouts.app')

@section('content')
<div class="container mx-auto p-4">
    <h2 class="text-xl font-bold mb-4">Edit Jurusan</h2>
    <form action="{{ route('jurusan.update', $jurusan) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="mb-4">
            <label class="block mb-1">Kode Jurusan</label>
            <input type="text" name="kode" class="border px-4 py-2 w-full" value="{{ old('kode', $jurusan->kode) }}" required>
        </div>
        <div class="mb-4">
            <label class="block mb-1">Nama Jurusan</label>
            <input type="text" name="nama" class="border px-4 py-2 w-full" value="{{ old('nama', $jurusan->nama) }}" required>
        </div>
        <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Update</button>
        <a href="{{ route('jurusan.index') }}" class="ml-2">Batal</a>
    </form>
</div>
@endsection
