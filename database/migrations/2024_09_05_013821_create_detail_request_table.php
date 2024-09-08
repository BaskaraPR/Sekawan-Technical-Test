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
        Schema::create('detail_request', function (Blueprint $table) {
            $table->id('id');
            $table->unsignedBigInteger('id_request');
            $table->foreign('id_request')->references('id')->on('request')->cascadeOnUpdate()->cascadeOnDelete();
            $table->bigInteger('fuel_usage');
            $table->dateTime('used_at');
            $table->dateTime('returned_at');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('detail_request');
    }
};
