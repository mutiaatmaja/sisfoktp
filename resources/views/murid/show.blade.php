@extends('layouts.app')

@section('content')
    <div class="container mx-auto p-4">
        <h2 class="text-xl font-bold mb-4">Detail Siswa</h2>
        <div class="bg-white shadow rounded-lg p-6 flex flex-col md:flex-row gap-6">
            <div class="flex-shrink-0 flex flex-col items-center">

                <img src="{{ $murid->foto ? asset('storage/public/foto-murid/' . $murid->foto) . '?v=' . time() : 'https://ui-avatars.com/api/?name=' . urlencode($murid->nama) . '&size=128' }}"
                    alt="Foto"
                    style="width:112px;height:168px;object-fit:cover;border-radius:8px;border:2px solid #ccc;margin-bottom:1rem;">
                <span class="font-semibold text-lg">{{ $murid->nama }}</span>
                <span class="text-sm text-gray-500">{{ $murid->nisn }}</span>
            </div>
            <div class="flex-1">
                <table class="w-full text-sm">
                    <tr>
                        <td class="font-semibold w-40">NIS</td>
                        <td>: {{ $murid->nis }}</td>
                    </tr>
                    <tr>
                        <td class="font-semibold">NIK</td>
                        <td>: {{ $murid->nik }}</td>
                    </tr>
                    <tr>
                        <td class="font-semibold">Nama</td>
                        <td>: {{ $murid->nama }}</td>
                    </tr>
                    <tr>
                        <td class="font-semibold">Tempat Lahir</td>
                        <td>: {{ $murid->tempat_lahir }}</td>
                    </tr>
                    <tr>
                        <td class="font-semibold">Tanggal Lahir</td>
                        <td>: {{ \Carbon\Carbon::parse($murid->tanggal_lahir)->translatedFormat('j F Y') }}</td>
                    </tr>
                    <tr>
                        <td class="font-semibold">Jenis Kelamin</td>
                        <td>: {{ $murid->jenis_kelamin == 'L' ? 'Laki-laki' : 'Perempuan' }}</td>
                    </tr>
                    <tr>
                        <td class="font-semibold">Kelas</td>
                        <td>: {{ $murid->kelas->nama ?? '-' }}</td>
                    </tr>
                    <tr>
                        <td class="font-semibold">Jurusan</td>
                        <td>: {{ $murid->jurusan->nama ?? '-' }}</td>
                    </tr>
                </table>
            </div>
        </div>
        <div class="mt-6">
            <a href="{{ route('murid.index') }}" class="bg-gray-500 text-white px-4 py-2 rounded">Kembali</a>
            <a href="{{ route('murid.edit', $murid) }}" class="bg-yellow-500 text-white px-4 py-2 rounded ml-2">Edit</a>
        </div>
    </div>
@endsection
