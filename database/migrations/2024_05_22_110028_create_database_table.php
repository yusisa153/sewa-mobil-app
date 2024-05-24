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
        Schema::create('mobil', function (Blueprint $table) {
            $table->id();
            $table->string('merek');
            $table->string('model');
            $table->string('plat_nomor');
            $table->integer('tarif');
            $table->boolean('status_sewa');
            $table->integer('user_id');
            $table->foreign('user_id')->references('id')->on('users');
            $table->timestamps();
        });

        Schema::create('peminjaman', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id');
            $table->foreign('user_id')->references('id')->on('users');
            $table->integer('mobil_id');
            $table->foreign('mobil_id')->references('id')->on('mobil');
            $table->date('tanggal_mulai');
            $table->date('tanggal_selesai');
            $table->integer('total_biaya');
            $table->boolean('status_pengembalian');
            $table->timestamps();
        });

        Schema::create('pengembalian', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id');
            $table->foreign('user_id')->references('id')->on('users');
            $table->integer('peminjaman_id');
            $table->foreign('peminjaman_id')->references('id')->on('peminjaman');
            $table->dateTime('tanggal_pengembalian');
            $table->integer('total_hari');
            $table->integer('total_biaya');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mobil');

        Schema::dropIfExists('peminjaman');

        Schema::dropIfExists('pengembalian');
    }
};
