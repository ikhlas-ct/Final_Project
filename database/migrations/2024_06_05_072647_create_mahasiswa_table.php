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
        Schema::create('tb_mahasiswa', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('fakultas_id'); // Menambah kolom fakultas_id
            $table->string('nama')->nullable();
            $table->string('nim')->unique()->nullable();
            $table->string('no_hp', 20)->nullable();
            $table->string('poto')->nullable();
            $table->timestamps();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('fakultas_id')->references('id')->on('tb_fakultas')->onDelete('cascade'); // Menambah foreign key ke tb_fakultas
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tb_mahasiswa');
    }
};
