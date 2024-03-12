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
        Schema::create('treatments', function (Blueprint $table) {
            $table->id();
            $table->string('code');
            $table->unsignedBigInteger('d_id');
            $table->foreign('d_id')->references('id')->on('user')->onDelete('cascade');
            $table->unsignedBigInteger('patient_id');
            $table->foreign('patient_id')->references('id')->on('patients')->onDelete('cascade');
            $table->string('symptom')->nullable();
            $table->string('heartbeat')->nullable();
            $table->string('pressure')->nullable();
            $table->string('temperature')->nullable();
            $table->string('breast')->nullable();
            $table->float('weight')->nullable();
            $table->float('height')->nullable();
            $table->string('vak­_saeng')->nullable();
            $table->string('bongmati')->nullable();
            $table->string('treatment')->nullable();
            $table->string('next_forward')->nullable();
            $table->string('date')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('treatments');
    }
};
