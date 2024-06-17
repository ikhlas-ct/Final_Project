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
        Schema::create('tb_bimbingan_p1', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('pembimbing1_id');
            $table->dateTime('tanggal');
            $table->dateTime('tanggal_reschedule')->nullable();
            $table->enum('status', ['diterima', 'diproses', 'selesai'])->default('diproses');;
            $table->foreign('pembimbing1_id')->references('id')->on('tb_pembimbing1')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tb_bimbingan_p1');
    }
};
