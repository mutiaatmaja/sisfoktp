<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

use App\Models\Kelas;
use App\Models\Murid;
Route::get('/dashboard', function () {
    $kelasList = Kelas::all();
    $muridTanpaFoto = [];
    foreach ($kelasList as $kelas) {
        $jumlah = Murid::where('kelas_id', $kelas->id)->where(function($q){ $q->whereNull('foto')->orWhere('foto',''); })->count();
        $muridTanpaFoto[] = [
            'id' => $kelas->id,
            'kelas' => $kelas->nama,
            'jumlah' => $jumlah
        ];
    }
    return view('dashboard', compact('muridTanpaFoto'));
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::put('/profile/password', [ProfileController::class, 'updatePassword'])->name('profile.updatePassword');
    Route::get('kelas/rombel', [App\Http\Controllers\KelasController::class, 'rombel'])->name('kelas.rombel');
    Route::get('kelas/{id}/siswa', [App\Http\Controllers\KelasController::class, 'siswa'])->name('kelas.siswa');
    Route::get('kelas/{id}/cetak-pdf', [App\Http\Controllers\KelasController::class, 'cetakPdf'])->name('kelas.cetakPdf');
    Route::get('/profile', [ProfileController::class, 'show'])->name('profile.show');
    Route::put('/profile', [ProfileController::class, 'update'])->name('profile.update');

    Route::resource('jurusan', App\Http\Controllers\JurusanController::class);
    Route::resource('kelas', App\Http\Controllers\KelasController::class);
    Route::resource('murid', App\Http\Controllers\MuridController::class);
    Route::get('murid-cetak-pdf', [App\Http\Controllers\MuridController::class, 'cetakPdf'])->name('murid.cetakPdf');
    Route::get('murid-cetak-pdf-jurusan/{jurusan_id}', [App\Http\Controllers\MuridController::class, 'cetakPdfJurusan'])->name('murid.cetakPdfJurusan');
    Route::post('murid/import-excel', [App\Http\Controllers\MuridController::class, 'importExcel'])->name('murid.importExcel');
});

require __DIR__.'/auth.php';
