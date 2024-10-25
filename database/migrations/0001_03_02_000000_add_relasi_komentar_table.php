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
        Schema::table('komentar', function (Blueprint $table) {
            $table->foreign('test_result_id')->references('id')->on('test_results');
            $table->foreign('user_id_penugasan')->references('id')->on('users');
            $table->tinyInteger('k_status')->unsigned()->change(); // Ubah tipe data
            $table->foreign('k_status')->references('k_status')->on('m_status');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('komentar', function (Blueprint $table) {
            // Menghapus foreign key
            $table->dropForeign(['test_result_id']);
            $table->dropForeign(['user_id_penugasan']);
            $table->dropForeign(['k_status']);
        });
    }
};
