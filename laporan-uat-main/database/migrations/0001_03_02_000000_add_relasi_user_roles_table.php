<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('user_roles', function (Blueprint $table) {
            // Menambahkan foreign key constraints
            $table->foreign('role_id')->references('id')->on('roles');
            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('project_id')->references('id')->on('project');
        });
    }


    public function down(): void
    {
        Schema::table('user_roles', function (Blueprint $table) {
            // Menghapus foreign key constraints
            $table->dropForeign(['role_id']);
            $table->dropForeign(['user_id']);
            $table->dropForeign(['project_id']);
        });
    }
};
