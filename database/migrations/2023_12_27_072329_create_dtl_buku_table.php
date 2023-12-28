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
        Schema::create('dtl_buku', function (Blueprint $table) {
            $table->id();
            $table->foreignId('buku_id')->constrained('mst_buku', 'id');
            $table->foreignId('trx_in_id')->constrained('trx_buku', 'id');
            $table->string('sn_buku')->unique();
            $table->string('no_rak')->nullable();
            $table->enum('status', ['disimpan', 'dipinjam']);
            $table->timestamps();
            $table->foreignId('created_by');
            $table->foreignId('updated_by')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('dtl_buku');
    }
};
