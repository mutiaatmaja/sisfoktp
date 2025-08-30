@extends('layouts.app')

@section('content')
<div class="container mx-auto p-4">
    <h2 class="text-xl font-bold mb-4">Siswa Rombel (Kelas)</h2>
    <table class="min-w-full bg-white border">
        <thead>
            <tr>
                <th class="border px-4 py-2">Nama Kelas</th>
                <th class="border px-4 py-2">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($kelas as $kls)
            <tr>
                <td class="border px-4 py-2">{{ $kls->nama }}</td>
                <td class="border px-4 py-2">
                    <a href="{{ route('kelas.siswa', $kls->id) }}" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded">Lihat Siswa</a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
