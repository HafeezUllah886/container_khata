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
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
            $table->date('date');
            $table->decimal('cr', 15, 2)->default(0);
            $table->decimal('db', 15, 2)->default(0);
            $table->text('notes')->nullable();
            $table->decimal('rate', 15, 2)->default(1);
            $table->decimal('uae', 15, 2)->default(0);
            $table->string('container')->nullable();
            $table->bigInteger('refID');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transactions');
    }
};
