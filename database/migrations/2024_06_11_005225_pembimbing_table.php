<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    public function up(): void
    {
        Schema::create('tb_pembimbing', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('pengajuan_id');
            // $table->unsignedBigInteger('pembimbing_1');
            // $table->unsignedBigInteger('pembimbing_2');
            // $table->foreign('pengajuan_id')->references('id')->on('tb_pengajuan')->onDelete('cascade');
            // $table->foreign('pembimbing_1')->references('id')->on('dosen')->onDelete('cascade');
            // $table->foreign('pembimbing_2')->references('id')->on('dosen')->onDelete('cascade');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('tb_pembimbing');
    }
};
