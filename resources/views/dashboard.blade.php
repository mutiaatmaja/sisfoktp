@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto sm:px-6 lg:px-8 py-8">
    <div class="bg-white shadow rounded-lg p-6">
        <h2 class="font-bold text-xl mb-6">Dashboard</h2>
        <h3 class="font-bold mb-4">Jumlah Murid Belum Memiliki Foto per Kelas</h3>
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
            @foreach($muridTanpaFoto as $row)
                <a href="{{ route('kelas.siswa', ['id' => $row['id']]) }}" class="bg-white border border-gray-200 rounded-lg shadow p-6 flex flex-col items-center hover:bg-blue-50 transition cursor-pointer">
                    <div class="text-lg font-semibold mb-2">{{ $row['kelas'] }}</div>
                    <div class="text-3xl font-bold text-blue-600">{{ $row['jumlah'] }}</div>
                    <div class="text-xs text-gray-500 mt-1">murid belum memiliki foto</div>
                </a>
            @endforeach
        </div>
    </div>
</div>
@endsection
