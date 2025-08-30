<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('murids', function (Blueprint $table) {
            $table->id();
            $table->uuid('uuid')->unique();
            $table->string('nisn')->unique();
            $table->string('nis')->unique();
            $table->string('nik')->unique();
            $table->string('nama');
            $table->string('tempat_lahir');
            $table->date('tanggal_lahir');
            $table->enum('jenis_kelamin', ['L', 'P']);
            $table->unsignedBigInteger('kelas_id');
            $table->unsignedBigInteger('jurusan_id');
            $table->string('foto')->nullable();
            $table->timestamps();

            $table->foreign('kelas_id')->references('id')->on('kelas')->onDelete('cascade');
            $table->foreign('jurusan_id')->references('id')->on('jurusans')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('murids');
    }
};
