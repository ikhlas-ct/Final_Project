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
        Schema::create('tb_bimbingan_p2', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('dosen_id');
            $table->unsignedBigInteger('mahasiswa_id');
            // $table->unsignedBigInteger('pembimbing_p2_id');
            $table->date('tanggal');
            $table->date('tanggal_reschedule')->nullable();
            $table->enum('status', ['diterima', 'diproses', 'selesai'])->default('diproses');
            $table->foreign('dosen_id')->references('id')->on('tb_dosen')->onDelete('cascade');
            $table->foreign('mahasiswa_id')->references('id')->on('tb_mahasiswa')->onDelete('cascade');
            // $table->foreign('pembimbing_p2_id')->references('id')->on('tb_pembimbing2')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tb_bimbingan_p2');
    }
};
