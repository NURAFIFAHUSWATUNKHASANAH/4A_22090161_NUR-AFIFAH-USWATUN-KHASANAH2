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
        Schema::create('alternatif', function (Blueprint $table) {
            $table->id();
            $table->string('nip', 20);
            $table->string('nama', 50)->nullable();
            $table->integer('c1');
            $table->integer('c2');
            $table->integer('c3');
            $table->integer('c4');
            $table->integer('c5');
            $table->timestamps();

            $table->foreign('nip')->references('nip')->on('daftar_pegawai')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('alternatif');
    }
};
