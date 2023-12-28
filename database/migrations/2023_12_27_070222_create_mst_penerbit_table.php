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
        Schema::create('mst_penerbit', function (Blueprint $table) {
            $table->id();
            $table->string('nm_penerbit');
            $table->string('alamat');
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
        Schema::dropIfExists('mst_penerbit');
    }
};
