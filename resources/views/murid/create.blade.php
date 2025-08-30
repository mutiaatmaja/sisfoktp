@extends('layouts.app')

@section('content')
<div class="container mx-auto p-4">
    <h2 class="text-xl font-bold mb-4">Tambah Murid</h2>
    <form action="{{ route('murid.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="mb-4">
            <label class="block mb-1">NISN</label>
            <input type="text" name="nisn" class="border px-4 py-2 w-full" value="{{ old('nisn') }}" required>
        </div>
        <div class="mb-4">
            <label class="block mb-1">NIS</label>
            <input type="text" name="nis" class="border px-4 py-2 w-full" value="{{ old('nis') }}" required>
        </div>
        <div class="mb-4">
            <label class="block mb-1">NIK</label>
            <input type="text" name="nik" class="border px-4 py-2 w-full" value="{{ old('nik') }}" required>
        </div>
        <div class="mb-4">
            <label class="block mb-1">Nama</label>
            <input type="text" name="nama" class="border px-4 py-2 w-full" value="{{ old('nama') }}" required>
        </div>
        <div class="mb-4">
            <label class="block mb-1">Tempat Lahir</label>
            <input type="text" name="tempat_lahir" class="border px-4 py-2 w-full" value="{{ old('tempat_lahir') }}" required>
        </div>
        <div class="mb-4">
            <label class="block mb-1">Tanggal Lahir</label>
            <input type="date" name="tanggal_lahir" class="border px-4 py-2 w-full" value="{{ old('tanggal_lahir') }}" required>
        </div>
        <div class="mb-4">
            <label class="block mb-1">Jenis Kelamin</label>
            <select name="jenis_kelamin" class="border px-4 py-2 w-full" required>
                <option value="">Pilih</option>
                <option value="L" {{ old('jenis_kelamin') == 'L' ? 'selected' : '' }}>Laki-laki</option>
                <option value="P" {{ old('jenis_kelamin') == 'P' ? 'selected' : '' }}>Perempuan</option>
            </select>
        </div>
        <div class="mb-4">
            <label class="block mb-1">Kelas</label>
            <select name="kelas_id" class="border px-4 py-2 w-full" required>
                <option value="">Pilih</option>
                @foreach($kelas as $kls)
                    <option value="{{ $kls->id }}" {{ old('kelas_id') == $kls->id ? 'selected' : '' }}>{{ $kls->nama }}</option>
                @endforeach
            </select>
        </div>
        <div class="mb-4">
            <label class="block mb-1">Jurusan</label>
            <select name="jurusan_id" class="border px-4 py-2 w-full" required>
                <option value="">Pilih</option>
                @foreach($jurusan as $jrs)
                    <option value="{{ $jrs->id }}" {{ old('jurusan_id') == $jrs->id ? 'selected' : '' }}>{{ $jrs->nama }}</option>
                @endforeach
            </select>
        </div>
        <div class="mb-4">
            <label class="block mb-1">Foto</label>
            <input type="file" name="foto" class="border px-4 py-2 w-full">
        </div>
        <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Simpan</button>
        <a href="{{ route('murid.index') }}" class="ml-2">Batal</a>
    </form>
</div>
@endsection
