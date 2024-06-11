<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateListPembimbingTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('tb_list_pembimbing', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('dosen_id');
            $table->unsignedBigInteger('pengajuan_id');
            $table->timestamps();
            $table->foreign('dosen_id')->references('id')->on('tb_dosen')->onDelete('cascade');
            $table->foreign('pengajuan_id')->references('id')->on('tb_pengajuan')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tb_list_pembimbing');
    }
}
