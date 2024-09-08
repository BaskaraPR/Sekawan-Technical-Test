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
        Schema::create('request', function (Blueprint $table) {
            $table->id('id');

            $table->unsignedBigInteger('id_user');
            $table->unsignedBigInteger('id_driver');
            $table->unsignedBigInteger('id_vehicle');

            $table->foreign('id_user')->references('id')->on('user')->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreign('id_driver')->references('id')->on('driver')->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreign('id_vehicle')->references('id')->on('vehicle')->cascadeOnUpdate()->cascadeOnDelete();

            $table->enum('admin_approval',['approved','rejected','pending'])->default('pending');
            $table->enum('approver_approval',['approved','rejected','pending'])->default('pending');
            $table->enum('status',['approved','rejected','pending'])->default('pending');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('request');
    }
};
