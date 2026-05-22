<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('pesanans', function (Blueprint $table) {
            $table->string('nama')->nullable()->after('user_id');
            $table->string('no_hp')->nullable()->after('nama');
            $table->text('alamat')->nullable()->after('no_hp');
            $table->text('catatan_alamat')->nullable()->after('alamat');
            $table->enum('metode_pengiriman', ['toko', 'kirim'])->default('toko')->after('catatan_alamat');
            $table->string('tulisan_kue')->nullable()->after('metode_pengiriman');
            $table->text('catatan_custom')->nullable()->after('tulisan_kue');
        });
    }

    public function down(): void
    {
        Schema::table('pesanans', function (Blueprint $table) {
            $table->dropColumn([
                'nama', 'no_hp', 'alamat', 'catatan_alamat',
                'metode_pengiriman', 'tulisan_kue', 'catatan_custom',
            ]);
        });
    }
};
