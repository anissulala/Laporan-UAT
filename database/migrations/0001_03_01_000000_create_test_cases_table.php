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
        Schema::create('test_cases', function (Blueprint $table) {
            $table->id();
            $table->string('kode', 255);
            $table->foreignId('test_suite_id');
            $table->string('judul', 255);
            $table->text('prakondisi')->nullable();
            $table->text('tahap_testing')->nullable();
            $table->text('data_input')->nullable();
            $table->tinyInteger('progress')->default(0);
            $table->timestamps();
    
            // Menambahkan unique index gabungan antara 'kode' dan 'test_suite_id'
            $table->unique(['kode', 'test_suite_id']);
        });
    }    

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('test_cases');
    }
};
