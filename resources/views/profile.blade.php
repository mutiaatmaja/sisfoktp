@extends('layouts.app')

@section('content')
<div class="max-w-xl mx-auto mt-10">
    <div class="bg-white shadow rounded-lg p-8">
        <h2 class="text-2xl font-bold mb-6 text-center">Profil Saya</h2>
        <form method="POST" action="{{ route('profile.update') }}">
            @csrf
            @method('PUT')
            <div class="mb-4">
                <label class="block text-gray-700 font-semibold mb-2">Nama</label>
                <input type="text" name="name" value="{{ old('name', auth()->user()->name) }}" class="w-full border rounded px-3 py-2 focus:outline-none focus:ring" required>
            </div>
            <div class="mb-4">
                <label class="block text-gray-700 font-semibold mb-2">Email</label>
                <input type="email" name="email" value="{{ old('email', auth()->user()->email) }}" class="w-full border rounded px-3 py-2 focus:outline-none focus:ring" required>
            </div>
            <div class="mb-4">
                <label class="block text-gray-700 font-semibold mb-2">Password Baru <span class="text-xs text-gray-500">(kosongkan jika tidak ingin mengganti)</span></label>
                <input type="password" name="password" class="w-full border rounded px-3 py-2 focus:outline-none focus:ring">
            </div>
            <div class="mb-4">
                <label class="block text-gray-700 font-semibold mb-2">Konfirmasi Password Baru</label>
                <input type="password" name="password_confirmation" class="w-full border rounded px-3 py-2 focus:outline-none focus:ring">
            </div>
            <button type="submit" class="w-full bg-blue-600 text-white font-bold py-2 rounded hover:bg-blue-700 transition">Simpan Perubahan</button>
        </form>
    </div>
</div>
@endsection
