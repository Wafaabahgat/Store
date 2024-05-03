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
        Schema::create('stores', function (Blueprint $table) {
            // $table->bigInteger('id')->unsigned()->autoIncrement()->primary();
            // $table->unsignedBigInteger('id')->autoIncrement()->primary();
            // $table->bigIncrements('id')->primary();
            $table->id();
            $table->string('name');
            $table->string('slug')->unique();
            $table->name('description')->nullable();
            $table->string('image')->nullable();
            $table->enum('status',['active','inactive'])->default('active');
            $table->timestamps();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('stores');
    }
};
