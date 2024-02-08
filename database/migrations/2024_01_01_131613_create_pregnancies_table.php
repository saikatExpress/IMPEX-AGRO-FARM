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
        Schema::create('pregnancies', function (Blueprint $table) {
            $table->id();
            
            $table->string('cow_id')->nullable();
            $table->string('pregnancy_type')->nullable();
            $table->string('push_date')->nullable();
            $table->string('start_date')->nullable();
            $table->string('semen_cost')->nullable();
            $table->string('other_cost')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pregnancies');
    }
};
