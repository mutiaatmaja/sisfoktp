@extends('layouts.app')

@section('content')
<div class="container mx-auto p-4">
    <h2 class="text-xl font-bold mb-4">Daftar Murid Tanpa Foto</h2>
    @foreach($murids as $kelas => $list)
        <h3 class="font-semibold text-lg mt-6 mb-2">Kelas: {{ $kelas }}</h3>
        <table class="min-w-full bg-white border mb-4">
            <thead>
                <tr>
                    <th class="border px-4 py-2">NISN</th>
                    <th class="border px-4 py-2">NIS</th>
                    <th class="border px-4 py-2">Nama</th>
                    <th class="border px-4 py-2">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($list as $murid)
                <tr>
                    <td class="border px-4 py-2">{{ $murid->nisn }}</td>
                    <td class="border px-4 py-2">{{ $murid->nis }}</td>
                    <td class="border px-4 py-2">{{ $murid->nama }}</td>
                    <td class="border px-4 py-2">
                        <a href="{{ route('murid.view', $murid) }}" class="bg-blue-500 hover:bg-blue-600 text-white px-2 py-1 rounded">View</a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    @endforeach
</div>
@endsection
