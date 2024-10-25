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
        Schema::table('test_cases', function (Blueprint $table) {
            // Menambahkan foreign key ke kolom test_suite_id
            $table->foreign('test_suite_id')->references('id')->on('test_suite');  // Jika test_suite dihapus, data test_case juga dihapus
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('test_cases', function (Blueprint $table) {
            // Menghapus foreign key
            $table->dropForeign(['test_suite_id']);
        });
    }
};
