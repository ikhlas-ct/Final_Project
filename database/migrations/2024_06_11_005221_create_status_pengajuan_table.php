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
        Schema::create('tb_status_pengajuan', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('pengajuan_id');
            $table->unsignedBigInteger('dosen_id');
            $table->enum('status', ['diterima', 'ditolak', 'diproses'])->default('diproses');
            $table->text('keterangan')->nullable();
            $table->timestamps();
            $table->foreign('pengajuan_id')->references('id')->on('tb_pengajuan')->onDelete('cascade');
            $table->foreign('dosen_id')->references('id')->on('tb_dosen')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('status_pengajuan');
    }
};
