
@php
    // Ambil nama kelas dan jurusan dari $kelas dan murids
    $kelasNama = isset($kelas) ? $kelas->nama : (isset($murids[0]) ? ($murids[0]->kelas->nama ?? '-') : '-');
    $jurusanNama = isset($murids[0]) ? ($murids[0]->jurusan->nama ?? '-') : '-';
@endphp
<html>
<head>
    <style>
        @page { size: landscape; }
        table { width: 100%; border-collapse: collapse; }
        th, td { border: 1px solid #333; padding: 4px; font-size: 12px; }
        th { background: #eee; }
        .foto-murid {
            width: 56px; /* 2cm */
            height: 84px; /* 3cm */
            object-fit: cover;
        }
    </style>
</head>
<body>
    <h2 style="text-align:center;">Data Murid Kelas {{ $kelasNama }} - Jurusan {{ $jurusanNama }}</h2>
    <table>
        <thead>
            <tr>
                <th>NIK</th>
                <th>NIS</th>
                <th>NISN</th>
                <th>Nama</th>
                <th>Tempat Lahir</th>
                <th>Tanggal Lahir</th>
                <th>Jurusan</th>
                <th>Foto</th>
                <th>Jenis Kelamin</th>
                <th>Kelas</th>
            </tr>
        </thead>
        <tbody>
            @foreach($murids as $murid)
                <tr>
                    <td>{{ $murid->nik }}</td>
                    <td>{{ $murid->nis }}</td>
                    <td>{{ $murid->nisn }}</td>
                    <td>{{ $murid->nama }}</td>
                    <td>{{ $murid->tempat_lahir }}</td>
                    <td>{{ \Carbon\Carbon::parse($murid->tanggal_lahir)->translatedFormat('j F Y') }}</td>
                    <td>{{ $murid->jurusan->nama ?? '-' }}</td>
                    <td>
                        @if($murid->foto)
                            <img src="{{ public_path('storage/foto-murid/'.$murid->foto) }}" class="foto-murid" alt="Foto">
                        @else
                            -
                        @endif
                    </td>
                    <td>{{ $murid->jenis_kelamin }}</td>
                    <td>{{ $murid->kelas->nama ?? '-' }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
