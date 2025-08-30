@extends('layouts.app')

@section('content')
<div class="container mx-auto p-4">
    <h2 class="text-xl font-bold mb-4">Daftar Jurusan</h2>
    <a href="{{ route('jurusan.create') }}" class="bg-blue-500 text-white px-4 py-2 rounded mb-4 inline-block">Tambah Jurusan</a>
    <table class="min-w-full bg-white border">
        <thead>
            <tr>
                <th class="border px-4 py-2">Kode</th>
                <th class="border px-4 py-2">Nama</th>
                <th class="border px-4 py-2">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($jurusans as $jurusan)
            <tr>
                <td class="border px-4 py-2">{{ $jurusan->kode }}</td>
                <td class="border px-4 py-2">{{ $jurusan->nama }}</td>
                <td class="border px-4 py-2">
                    <a href="{{ route('jurusan.edit', $jurusan) }}" class="bg-yellow-400 text-white px-2 py-1 rounded">Edit</a>
                    <form action="{{ route('jurusan.destroy', $jurusan) }}" method="POST" class="inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="bg-red-500 text-white px-2 py-1 rounded" onclick="return confirm('Yakin hapus?')">Hapus</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
