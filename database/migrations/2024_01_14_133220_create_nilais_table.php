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
        Schema::create('nilai', function (Blueprint $table) {
            $table->integer('no_reg');
            $table->unique('no_reg');
            $table->string('email');
            $table->string('nama');
            $table->string('dokumen');
            $table->string('original_filename')->nullable();
            $table->string('resultI');
            $table->string('resultE');
            $table->string('resultS');
            $table->string('resultN');
            $table->string('resultT');
            $table->string('resultF');
            $table->string('resultJ');
            $table->string('resultP');
            $table->string('result1');
            $table->string('result2');
            $table->string('result3');
            $table->string('result4');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('nilai');
    }
};
