@extends('layouts.app')

@section('content')
<div class="container mx-auto p-4">
    @if ($errors->any())
        <div class="mb-4 p-3 bg-red-100 text-red-800 rounded border border-red-300">
            <ul class="list-disc pl-5">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <h2 class="text-xl font-bold mb-4">Edit Murid</h2>
    <form action="{{ route('murid.update', $murid) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="mb-4">
            <label class="block mb-1">NISN</label>
            <input type="text" name="nisn" class="border px-4 py-2 w-full" value="{{ old('nisn', $murid->nisn) }}" required>
        </div>
        <div class="mb-4">
            <label class="block mb-1">NIS</label>
            <input type="text" name="nis" class="border px-4 py-2 w-full" value="{{ old('nis', $murid->nis) }}" required>
        </div>
        <div class="mb-4">
            <label class="block mb-1">NIK</label>
            <input type="text" name="nik" class="border px-4 py-2 w-full" value="{{ old('nik', $murid->nik) }}" required>
        </div>
        <div class="mb-4">
            <label class="block mb-1">Nama</label>
            <input type="text" name="nama" class="border px-4 py-2 w-full" value="{{ old('nama', $murid->nama) }}" required>
        </div>
        <div class="mb-4">
            <label class="block mb-1">Tempat Lahir</label>
            <input type="text" name="tempat_lahir" class="border px-4 py-2 w-full" value="{{ old('tempat_lahir', $murid->tempat_lahir) }}" required>
        </div>
        <div class="mb-4">
            <label class="block mb-1">Tanggal Lahir</label>
            <input type="date" name="tanggal_lahir" class="border px-4 py-2 w-full" value="{{ old('tanggal_lahir', $murid->tanggal_lahir) }}" required>
        </div>
        <div class="mb-4">
            <label class="block mb-1">Jenis Kelamin</label>
            <select name="jenis_kelamin" class="border px-4 py-2 w-full" required>
                <option value="">Pilih</option>
                <option value="L" {{ old('jenis_kelamin', $murid->jenis_kelamin) == 'L' ? 'selected' : '' }}>Laki-laki</option>
                <option value="P" {{ old('jenis_kelamin', $murid->jenis_kelamin) == 'P' ? 'selected' : '' }}>Perempuan</option>
            </select>
        </div>
        <div class="mb-4">
            <label class="block mb-1">Kelas</label>
            <select name="kelas_id" class="border px-4 py-2 w-full" required>
                <option value="">Pilih</option>
                @foreach($kelas as $kls)
                    <option value="{{ $kls->id }}" {{ old('kelas_id', $murid->kelas_id) == $kls->id ? 'selected' : '' }}>{{ $kls->nama }}</option>
                @endforeach
            </select>
        </div>
        <div class="mb-4">
            <label class="block mb-1">Jurusan</label>
            <select name="jurusan_id" class="border px-4 py-2 w-full" required>
                <option value="">Pilih</option>
                @foreach($jurusan as $jrs)
                    <option value="{{ $jrs->id }}" {{ old('jurusan_id', $murid->jurusan_id) == $jrs->id ? 'selected' : '' }}>{{ $jrs->nama }}</option>
                @endforeach
            </select>
        </div>
        <div class="mb-4">
            <label class="block mb-1">Foto</label>
            <div class="flex items-center gap-4">
                <img id="foto-preview" src="{{ $murid->foto ? asset('storage/public/foto-murid/'.$murid->foto) : 'https://ui-avatars.com/api/?name=Foto+Murid&size=128' }}" alt="Foto" class="h-20 w-20 object-cover rounded-full border">
                <input type="file" id="user" capture='environment' name="foto" accept="image/*" class="border px-4 py-2 w-full" onchange="previewFoto(event)">
            </div>
            <button type="button" onclick="openCamera()" class="mt-2 bg-green-600 text-white px-3 py-1 rounded">Ambil Foto Kamera</button>
            <div id="camera-modal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50 hidden">
                <div class="bg-white p-4 rounded shadow-lg">
                    <video id="video" width="320" height="240" autoplay class="mb-2"></video>
                    <br>
                    <button type="button" onclick="captureFoto()" class="bg-blue-600 text-white px-3 py-1 rounded">Capture</button>
                    <button type="button" onclick="closeCamera()" class="bg-gray-400 text-white px-3 py-1 rounded ml-2">Tutup</button>
                    <canvas id="canvas" width="320" height="240" class="hidden"></canvas>
                </div>
            </div>
            <input type="hidden" name="foto_camera" id="foto_camera">
        </div>
        <script>
        function previewFoto(event) {
            const reader = new FileReader();
            reader.onload = function(e) {
                document.getElementById('foto-preview').src = e.target.result;
            };
            reader.readAsDataURL(event.target.files[0]);
        }
        let stream;
        function openCamera() {
            document.getElementById('camera-modal').classList.remove('hidden');
            navigator.mediaDevices.getUserMedia({ video: true }).then(s => {
                stream = s;
                document.getElementById('video').srcObject = stream;
            });
        }
        function closeCamera() {
            document.getElementById('camera-modal').classList.add('hidden');
            if(stream) stream.getTracks().forEach(t => t.stop());
        }
        function captureFoto() {
            const video = document.getElementById('video');
            const canvas = document.getElementById('canvas');
            canvas.getContext('2d').drawImage(video, 0, 0, canvas.width, canvas.height);
            const dataUrl = canvas.toDataURL('image/png');
            document.getElementById('foto-preview').src = dataUrl;
            document.getElementById('foto_camera').value = dataUrl;
            closeCamera();
        }
        </script>
        <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Update</button>
        <a href="{{ route('murid.index') }}" class="ml-2">Batal</a>
    </form>
</div>
@endsection
