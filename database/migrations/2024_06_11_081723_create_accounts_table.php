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
        Schema::create('accounts', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('address_one')->nullable();
            $table->string('address_two')->nullable();
            $table->string('license')->nullable();
            $table->string('email')->nullable();
            $table->string('tel')->nullable();
            $table->string('po_box')->nullable();
            $table->string('type');
            $table->string('status')->default('Active');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('accounts');
    }
};
