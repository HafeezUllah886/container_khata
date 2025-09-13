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
        Schema::create('export_engines', function (Blueprint $table) {
            $table->id();
            $table->foreignId('export_id')->constrained('exports')->cascadeOnDelete();
            $table->string('series')->nullable();
            $table->string('model')->nullable();
            $table->float('price')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('export_engines');
    }
};
