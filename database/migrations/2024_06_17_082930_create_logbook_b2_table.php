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
        Schema::create('tb_logbook_b2', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('bimbingan_p2_id');
            $table->string('kegiatan');
            $table->text('detail_kegiatan');
            $table->foreign('bimbingan_p2_id')->references('id')->on('tb_bimbingan_p2')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tb_logbook_b2');
    }
};
