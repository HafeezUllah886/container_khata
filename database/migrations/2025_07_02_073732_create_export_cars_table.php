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
        Schema::create('export_cars', function (Blueprint $table) {
            $table->id();
            $table->foreignId('export_id')->constrained('exports')->cascadeOnDelete();
            $table->foreignId('purchase_id')->constrained('purchases')->cascadeOnDelete();
            $table->string('chassis');
            $table->float('price');
            $table->string('remarks')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('export_cars');
    }
};
