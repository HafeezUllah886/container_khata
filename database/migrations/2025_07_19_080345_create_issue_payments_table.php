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
        Schema::create('issue_payments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('category_id')->constrained('payment_categories','id');
            $table->foreignId('bank_id')->constrained('accounts','id');
            $table->date('date');
            $table->float('amount')->default(0);
            $table->text('notes')->nullable();
            $table->bigInteger('refID');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('issue_payments');
    }
};
