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
        Schema::create('vehicle', function (Blueprint $table) {
            $table->id('id');
            $table->string('name');
            $table->string('licensePlate');
            $table->text('description');
            $table->enum('ownership',['owned','third_party']);
            $table->enum('type',['cargo','passenger']);
            $table->enum('status',['available','unvailable','pending']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('vehicle');
    }
};
