@extends('layouts.app')

@section('content')
<div class="container mx-auto p-4">
    <h2 class="text-xl font-bold mb-4">Tambah Kelas</h2>
    <form action="{{ route('kelas.store') }}" method="POST">
        @csrf
        <div class="mb-4">
            <label class="block mb-1">Nama Kelas</label>
            <input type="text" name="nama" class="border px-4 py-2 w-full" value="{{ old('nama') }}" required>
        </div>
        <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Simpan</button>
        <a href="{{ route('kelas.index') }}" class="ml-2">Batal</a>
    </form>
</div>
@endsection
