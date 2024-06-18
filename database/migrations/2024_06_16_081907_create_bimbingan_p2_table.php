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
            $table->unsignedBigInteger('pembimbing2_id');
            $table->dateTime('tanggal');
            $table->dateTime('tanggal_reschedule')->nullable();
            $table->enum('status', ['diterima', 'diproses', 'selesai'])->default('diproses');;
            $table->foreign('pembimbing2_id')->references('id')->on('tb_pembimbing2')->onDelete('cascade');
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
