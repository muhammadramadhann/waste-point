<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('groceries_transactions', function (Blueprint $table) {
            $table->id();
            $table->string('nanoid')->unique();
            $table->foreignId('user_id')->constrained('users')->onUpdate('cascade')->onDelete('cascade');
            $table->foreignId('groceries_id')->constrained('groceries')->onUpdate('cascade')->onDelete('cascade');
            $table->integer('quantity');
            $table->integer('total_points');
            $table->string('note')->nullable();
            $table->string('status')->default('Dalam proses');
            $table->string('invoice_number')->nullable();
            $table->string('rating')->nullable();
            $table->string('feedback')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('groceries_transactions');
    }
};
