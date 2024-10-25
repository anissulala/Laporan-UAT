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
        Schema::create('komentar', function (Blueprint $table) {
            $table->id();
            $table->foreignId('test_result_id');
            $table->foreignId('user_id_penugasan');
            $table->foreignId('k_status');
            $table->text('komentar')->nullable();
            $table->date('tgl_komentar')->nullable();

            // Menambahkan kolom untuk menyimpan perubahan assignee dan status
            $table->string('old_assignee')->nullable(); // Nama penugasan lama
            $table->string('new_assignee')->nullable(); // Nama penugasan baru
            $table->string('old_status')->nullable();   // Status lama
            $table->string('new_status')->nullable();   // Status baru
            $table->boolean('is_edited')->default(false); // Menambahkan kolom is_edited
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('komentar');
    }
};
