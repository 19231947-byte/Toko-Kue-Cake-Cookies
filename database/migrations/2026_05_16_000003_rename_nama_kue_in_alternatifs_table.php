<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        DB::statement('ALTER TABLE `alternatifs` CHANGE `nama_kue` `nama_alternatif` VARCHAR(255) NOT NULL');
    }

    public function down(): void
    {
        DB::statement('ALTER TABLE `alternatifs` CHANGE `nama_alternatif` `nama_kue` VARCHAR(255) NOT NULL');
    }
};
