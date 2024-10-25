<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('test_suite', function (Blueprint $table) {
            $table->id();
            $table->string('kode', 255);// Menambahkan kolom kode
            $table->foreignId('project_id')->nullable();
            $table->string('judul', 255);
            $table->string('ref_tiket', 255)->nullable();
            $table->text('url')->nullable();
            $table->string('perangkat', 255)->nullable();
            $table->foreignId('user_id_pic')->nullable();
            $table->foreignId('user_id_scenario')->nullable();
            $table->foreignId('user_id_tester')->nullable();
            $table->text('batasan')->nullable();
            $table->date('tgl_mulai')->nullable();
            $table->date('tgl_selesai')->nullable();
            $table->tinyInteger('progress')->default(0);
            $table->timestamps();
            $table->unique(['kode', 'project_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('test_suite');
    }
};
