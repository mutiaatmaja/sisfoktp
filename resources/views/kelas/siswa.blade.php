@extends('layouts.app')

@section('content')
<div class="container mx-auto p-4">
    <h2 class="text-xl font-bold mb-4">Siswa Kelas: {{ $kelas->nama }}</h2>
    <a href="{{ route('kelas.cetakPdf', $kelas->id) }}" target="_blank" class="bg-purple-600 hover:bg-purple-700 text-white px-4 py-2 rounded mb-4 inline-block">Cetak PDF Siswa Kelas</a>
    <table class="min-w-full bg-white border">
        <thead>
            <tr>
                <th class="border px-4 py-2">NIK</th>
                <th class="border px-4 py-2">NIS</th>
                <th class="border px-4 py-2">NISN</th>
                <th class="border px-4 py-2">Nama</th>
                <th class="border px-4 py-2">Jurusan</th>
                <th class="border px-4 py-2">Foto</th>
                <th class="border px-4 py-2">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($murids as $murid)
            <tr>
                <td class="border px-4 py-2">{{ $murid->nik }}</td>
                <td class="border px-4 py-2">{{ $murid->nis }}</td>
                <td class="border px-4 py-2">{{ $murid->nisn }}</td>
                <td class="border px-4 py-2">{{ $murid->nama }}</td>
                <td class="border px-4 py-2">{{ $murid->jurusan->nama ?? '-' }}</td>
                <td class="border px-4 py-2">
                    @if($murid->foto)
                        <img src="{{ asset('storage/foto-murid/'.$murid->foto) }}" alt="Foto" class="h-12 w-12 object-cover rounded-full">
                    @else
                        -
                    @endif
                </td>
                <td class="border px-4 py-2">
                    <a href="{{ route('murid.edit', $murid) }}" class="bg-yellow-500 hover:bg-yellow-600 text-white px-2 py-1 rounded">Edit</a>
                    <form action="{{ route('murid.destroy', $murid) }}" method="POST" class="inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="bg-red-600 hover:bg-red-700 text-white px-2 py-1 rounded" onclick="return confirm('Yakin hapus?')">Hapus</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
