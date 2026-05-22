<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('pesanans', function (Blueprint $table) {
            // Tambah kolom data pemesan jika belum ada
            if (!Schema::hasColumn('pesanans', 'nama')) {
                $table->string('nama')->nullable()->after('user_id');
            }
            if (!Schema::hasColumn('pesanans', 'no_hp')) {
                $table->string('no_hp')->nullable()->after('nama');
            }
            if (!Schema::hasColumn('pesanans', 'alamat')) {
                $table->text('alamat')->nullable()->after('no_hp');
            }
            if (!Schema::hasColumn('pesanans', 'catatan_alamat')) {
                $table->text('catatan_alamat')->nullable()->after('alamat');
            }
            if (!Schema::hasColumn('pesanans', 'metode_pengiriman')) {
                $table->enum('metode_pengiriman', ['toko', 'kirim'])->default('toko')->after('catatan_alamat');
            }
            if (!Schema::hasColumn('pesanans', 'tulisan_kue')) {
                $table->string('tulisan_kue')->nullable()->after('metode_pengiriman');
            }
            if (!Schema::hasColumn('pesanans', 'catatan_custom')) {
                $table->text('catatan_custom')->nullable()->after('tulisan_kue');
            }
        });
    }

    public function down(): void
    {
        Schema::table('pesanans', function (Blueprint $table) {
            $table->dropColumn(array_filter([
                Schema::hasColumn('pesanans', 'nama')             ? 'nama'             : null,
                Schema::hasColumn('pesanans', 'no_hp')            ? 'no_hp'            : null,
                Schema::hasColumn('pesanans', 'alamat')           ? 'alamat'           : null,
                Schema::hasColumn('pesanans', 'catatan_alamat')   ? 'catatan_alamat'   : null,
                Schema::hasColumn('pesanans', 'metode_pengiriman')? 'metode_pengiriman': null,
                Schema::hasColumn('pesanans', 'tulisan_kue')      ? 'tulisan_kue'      : null,
                Schema::hasColumn('pesanans', 'catatan_custom')   ? 'catatan_custom'   : null,
            ]));
        });
    }
};
