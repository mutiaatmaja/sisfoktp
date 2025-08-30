@extends('layouts.app')

@section('content')
<div class="container mx-auto p-4">
    <h2 class="text-xl font-bold mb-4">Daftar Kelas</h2>
    <a href="{{ route('kelas.create') }}" class="bg-blue-500 text-white px-4 py-2 rounded mb-4 inline-block">Tambah Kelas</a>
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
                    <a href="{{ route('kelas.edit', $kls) }}" class="bg-yellow-400 text-white px-2 py-1 rounded">Edit</a>
                    <form action="{{ route('kelas.destroy', $kls) }}" method="POST" class="inline">
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
