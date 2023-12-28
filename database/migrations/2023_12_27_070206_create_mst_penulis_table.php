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
        Schema::create('mst_penulis', function (Blueprint $table) {
            $table->id();
            $table->string('nm_penulis');
            $table->date('tgl_lahir');
            $table->enum('jn_kelamin', ['L', 'P']);
            $table->text('text');
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
        Schema::dropIfExists('mst_penulis');
    }
};
