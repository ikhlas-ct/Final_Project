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
        Schema::create('tb_pembimbing1', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('judul_final_id');
            $table->unsignedBigInteger('dosen_id');
            $table->string('status')->nullable();
            $table->foreign('judul_final_id')->references('id')->on('tb_judul_final')->onDelete('cascade');
            $table->foreign('dosen_id')->references('id')->on('tb_dosen')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tb_pembimbing1');
    }
};
