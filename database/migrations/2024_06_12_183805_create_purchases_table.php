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
        Schema::create('purchases', function (Blueprint $table) {
            $table->id();
            $table->string("year")->nullable();
            $table->string("maker")->nullable();
            $table->string("model")->nullable();
            $table->string("chassis")->unique();
            $table->string("engine")->nullable();
            $table->string("yard")->nullable();
            $table->date('date')->nullable();
            $table->string("auction")->nullable();
            $table->double("price",15,2)->nullable();
            $table->double("ptax")->nullable();
            $table->double("transport_charges",15,2)->nullable();
            $table->double("total",15,2)->nullable();
            $table->double("rate",15,2)->default(0);
            $table->double("net_dirham",15,2)->default(0);
            $table->date('adate')->nullable();
            $table->date('ddate')->nullable();
            $table->string("number_plate")->nullable();
            $table->date('nvalidity')->nullable();
            $table->text('notes')->nullable();
            $table->string("status")->default("Available");
            $table->bigInteger('refID');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('purchases');
    }
};
