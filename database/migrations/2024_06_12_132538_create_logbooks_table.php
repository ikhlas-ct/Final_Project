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
        Schema::create('logbooks', function (Blueprint $table) {
            $table->id();
            $table->foreignId('mahasiswa_id')->constrained('tb_mahasiswa')->onDelete('cascade');
            $table->date('tanggal');
            $table->text('kegiatan');
            $table->text('detail');
            $table->enum('keterangan', ['ACC', 'REVISI', 'DIPROSES'])->default('DIPROSES');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('logbooks');
    }
};
