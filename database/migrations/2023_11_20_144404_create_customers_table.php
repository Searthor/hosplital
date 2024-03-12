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
        Schema::create('customers', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('vill_id');
            $table->foreign('vill_id')->references('id')->on('village')->onDelete('cascade');
            $table->unsignedBigInteger('dis_id');
            $table->foreign('dis_id')->references('id')->on('district')->onDelete('cascade');
            $table->unsignedBigInteger('pro_id');
            $table->foreign('pro_id')->references('id')->on('province')->onDelete('cascade');
            $table->string('name',255);
            $table->string('lastname',255)->nullable();
            $table->text('address')->nullable();
            $table->char('phone',20);
            $table->enum('gender', ['man', 'women','another']);
            $table->date('birthday');
            $table->integer('status');
            $table->string('nationality',20)->nullable();
            $table->integer('del')->default('1');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('customers');
    }
};
