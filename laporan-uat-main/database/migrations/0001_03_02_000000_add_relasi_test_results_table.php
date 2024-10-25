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
        Schema::table('test_results', function (Blueprint $table) {
            // Menambahkan foreign key constraints
            $table->foreign('test_case_id')->references('id')->on('test_cases');
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
        Schema::table('test_results', function (Blueprint $table) {
            // Menghapus foreign key constraints
            $table->dropForeign(['test_case_id']);
            $table->dropForeign(['user_id_penugasan']);
            $table->dropForeign(['k_status']);
        });
    }
};
