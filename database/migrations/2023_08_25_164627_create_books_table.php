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
        Schema::create('books', function (Blueprint $table) {
            $table->bigInteger('id')->autoIncrement();
            $table->string('kode_buku');
            $table->string('judul_buku');
            $table->string('kategori');
            $table->string('pengarang');
            $table->string('penerbit');
            $table->string('tanggal_publikasi');
            $table->bigInteger('stock')->nullable();
            $table->string('status');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('books');
    }
};
