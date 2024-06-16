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
        Schema::create('tb_reschedule', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('bimbingan_id');
            $table->date('tanggal');
            $table->foreign('bimbingan_id')->references('id')->on('tb_bimbingan')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reschedule');
    }
};
