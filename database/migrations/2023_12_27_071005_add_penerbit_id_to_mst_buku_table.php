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
        Schema::table('mst_buku', function (Blueprint $table) {
            $table->foreignId('penerbit_id')->after('judul')->constrained('mst_penerbit', 'id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('mst_buku', function (Blueprint $table) {
            $table->dropConstrainedForeignId('penerbit_id');
        });
    }
};
