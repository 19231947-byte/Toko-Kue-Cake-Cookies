<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (Schema::hasTable('keranjangs')) {
            return; // Tabel sudah ada, skip
        }

        Schema::create('keranjangs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->cascadeOnDelete();
            $table->foreignId('produk_id')->constrained('produks')->cascadeOnDelete();
            $table->foreignId('varian_id')->nullable()->constrained('produk_varian')->nullOnDelete();
            $table->string('nama_produk');
            $table->string('nama_varian')->nullable();
            $table->integer('harga');
            $table->string('gambar')->nullable();
            $table->integer('qty')->default(1);
            $table->timestamps();

            // Satu user tidak bisa punya item produk+varian yang sama dua kali
            $table->unique(['user_id', 'produk_id', 'varian_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('keranjangs');
    }
};
