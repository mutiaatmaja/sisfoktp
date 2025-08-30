@extends('layouts.app')

@section('content')
<div class="container mx-auto p-4">
    <h2 class="text-xl font-bold mb-4">Daftar Murid</h2>
    <a href="{{ route('murid.create') }}" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded mb-4 inline-block">Tambah Murid</a>
    <a href="{{ route('murid.cetakPdf') }}" target="_blank" class="bg-purple-600 hover:bg-purple-700 text-white px-4 py-2 rounded mb-4 inline-block ml-2">Cetak PDF Semua</a>
    @php $jurusanList = \App\Models\Jurusan::all(); @endphp
    @foreach($jurusanList as $jrs)
        <a href="{{ route('murid.cetakPdfJurusan', $jrs->id) }}" target="_blank" class="bg-indigo-600 hover:bg-indigo-700 text-white px-4 py-2 rounded mb-4 inline-block ml-2">Cetak PDF {{ $jrs->kode }}</a>
    @endforeach
    <form action="{{ route('murid.importExcel') }}" method="POST" enctype="multipart/form-data" class="mb-4 inline-block">
        @csrf
        <input type="file" name="file" accept=".xlsx,.xls" required class="border px-2 py-1">
    <button type="submit" class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded">Import Excel</button>
    </form>
    <table class="min-w-full bg-white border">
        <thead>
            <tr>
                <th class="border px-4 py-2">NISN</th>
                <th class="border px-4 py-2">NIS</th>
                <th class="border px-4 py-2">Nama</th>
                <th class="border px-4 py-2">Kelas</th>
                <th class="border px-4 py-2">Jurusan</th>
                <th class="border px-4 py-2">Foto</th>
                <th class="border px-4 py-2">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($murids as $murid)
            <tr>
                <td class="border px-4 py-2">{{ $murid->nisn }}</td>
                <td class="border px-4 py-2">{{ $murid->nis }}</td>
                <td class="border px-4 py-2">{{ $murid->nama }}</td>
                <td class="border px-4 py-2">{{ $murid->kelas->nama ?? '-' }}</td>
                <td class="border px-4 py-2">{{ $murid->jurusan->nama ?? '-' }}</td>
                <td class="border px-4 py-2">
                    @if($murid->foto)
                        <img src="{{ asset('storage/public/foto-murid/'.$murid->foto) }}" alt="Foto" class="h-12 w-12 object-cover rounded-full">
                    @else
                        -
                    @endif
                </td>
                <td class="border px-4 py-2">
                    <a href="{{ route('murid.show', $murid) }}" class="bg-blue-500 hover:bg-blue-600 text-white px-2 py-1 rounded">Lihat</a>
                    <a href="{{ route('murid.edit', $murid) }}" class="bg-yellow-500 hover:bg-yellow-600 text-white px-2 py-1 rounded ml-1">Edit</a>
                    <form action="{{ route('murid.destroy', $murid) }}" method="POST" class="inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="bg-red-600 hover:bg-red-700 text-white px-2 py-1 rounded ml-1" onclick="return confirm('Yakin hapus?')">Hapus</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
