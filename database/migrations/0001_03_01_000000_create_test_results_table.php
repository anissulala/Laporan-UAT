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
        Schema::create('test_results', function (Blueprint $table) {
            $table->id();
            $table->string('kode', 255);
            $table->foreignId('test_case_id');
            $table->foreignId('user_id_penugasan');
            $table->text('harapan')->nullable();
            $table->text('realisasi')->nullable();
            // Mengubah k_status menjadi foreign key
            $table->foreignId('k_status');
            $table->timestamps();

            // Menambahkan unique index gabungan antara 'kode' dan 'test_case_id'
            $table->unique(['kode', 'test_case_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('test_results');
    }
};
