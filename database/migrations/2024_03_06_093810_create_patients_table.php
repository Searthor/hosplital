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
        Schema::create('patients', function (Blueprint $table) {
            $table->id();
            $table->string('code',50);
            $table->string('f_name',100);
            $table->string('l_name',100)->nullable();
            $table->enum('gender', ['man', 'women','another']);
            $table->date('birthday');
            $table->string('phone',20)->nullable();
            $table->string('job',50)->nullable();
            $table->string('status',50)->nullable();
            $table->string('nationality',50);
            $table->string('ethnicity',50);
            $table->string('unit',50)->nullable();
            $table->string('house_number',10)->nullable();
            $table->string('village',50);
            $table->string('city',50);
            $table->string('province',50);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('patients');
    }
};
