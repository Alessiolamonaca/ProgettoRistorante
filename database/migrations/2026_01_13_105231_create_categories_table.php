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
        Schema::create('categories', function (Blueprint $table) {
            $table->id();
            $table->string('slug')->unique();
            $table->unsignedInteger('position')->default(0);

            // Nomi per lingua (per ora useremo solo name_it, le altre possono restare null)
            $table->string('name_it');
            $table->string('name_en')->nullable();
            $table->string('name_de')->nullable();
            $table->string('name_es')->nullable();
            $table->string('name_fr')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('categories');
    }
};
