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
        Schema::create('exports', function (Blueprint $table) {
            $table->id();
            $table->string('inv_no');
            $table->foreignId('consignee_id')->constrained('accounts')->cascadeOnDelete();
            $table->foreignId('info_party_id')->constrained('accounts')->cascadeOnDelete();
            $table->date('date');
            $table->string('c_no')->nullable();
            $table->string('weight')->nullable();
            $table->float('amount');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('exports');
    }
};
