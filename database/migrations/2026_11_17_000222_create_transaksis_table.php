<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('transaksis', function (Blueprint $table) {
            $table->id();
            $table->string('kode_transaksi')->unique();

            $table->foreignId('kendaraan_id')
                ->constrained('kendaraans');

            $table->foreignId('tarif_id')
                ->constrained('tarifs');

            $table->foreignId('area_id')
                ->constrained('areas');

            $table->foreignId('petugas_id')
                ->constrained('users');

            $table->dateTime('waktu_masuk');
            $table->dateTime('waktu_keluar')->nullable();

            $table->integer('durasi')->nullable();

            $table->decimal('total_biaya', 12, 2)
                ->default(0);

            $table->enum('status', [
                'parkir',
                'selesai'
            ])->default('parkir');

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('transaksis');
    }
};