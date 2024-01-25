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
            $table->integer('id')->autoIncrement();
            $table->string('no_reg')->unique();
            $table->string('email');
            $table->string('nama');
            $table->string('dokumen');
            $table->string('original_filename')->nullable();
            $table->float('average_score_i');
            $table->float('average_score_e');
            $table->float('average_score_s');
            $table->float('average_score_n');
            $table->float('average_score_t');
            $table->float('average_score_f');
            $table->float('average_score_j');
            $table->float('average_score_p');
            $table->string('result_1');
            $table->string('result_2');
            $table->string('result_3');
            $table->string('result_4');
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
