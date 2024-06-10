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
        Schema::create('juduls', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('pengajuan_id');
            $table->foreign('pengajuan_id')->references('id')->on('pengajuans')->onDelete('cascade');
            $table->string('judul');
            $table->string('konsentrasi');
            $table->string('file');
            $table->enum('status', ['diterima', 'ditolak', 'diproses'])->default('diproses');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('juduls');
    }
};
