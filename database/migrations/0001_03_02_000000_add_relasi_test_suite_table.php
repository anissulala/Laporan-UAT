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
        Schema::table('test_suite', function (Blueprint $table) {
            // Menambahkan foreign key constraints
            $table->foreign('project_id')->references('id')->on('project');
            $table->foreign('user_id_pic')->references('id')->on('users');
            $table->foreign('user_id_scenario')->references('id')->on('users');
            $table->foreign('user_id_tester')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('test_suite', function (Blueprint $table) {
            // Menghapus foreign key constraints
            $table->dropForeign(['project_id']);
            $table->dropForeign(['user_id_pic']);
            $table->dropForeign(['user_id_scenario']);
            $table->dropForeign(['user_id_tester']);
        });
    }
};
