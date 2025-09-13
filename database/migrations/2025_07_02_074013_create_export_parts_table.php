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
        Schema::create('export_parts', function (Blueprint $table) {
            $table->id();
            $table->foreignId('export_id')->constrained('exports')->cascadeOnDelete();
            $table->string('part_name');
            $table->float('qty');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('export_parts');
    }
};
