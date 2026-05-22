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
        Schema::table('pesanans', function (Blueprint $table) {
            $table->enum('status_pembayaran', ['Belum Bayar', 'Sudah Bayar'])->default('Belum Bayar')->after('total_harga');
            $table->string('status')->default('Pending')->change();
        });

        Schema::dropIfExists('pembayarans');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::create('pembayarans', function (Blueprint $table) {
            $table->id();
            $table->foreignId('pesanan_id')->constrained('pesanans')->cascadeOnUpdate()->cascadeOnDelete();
            $table->enum('metode', ['transfer', 'e-wallet']);
            $table->enum('status_pembayaran', ['belum_bayar', 'sudah_bayar'])->default('belum_bayar');
            $table->timestamp('tanggal_pembayaran')->nullable();
            $table->timestamps();
        });

        Schema::table('pesanans', function (Blueprint $table) {
            $table->dropColumn('status_pembayaran');
            $table->enum('status', ['menunggu', 'diproses', 'dikirim', 'selesai'])->default('menunggu')->change();
        });
    }
};
