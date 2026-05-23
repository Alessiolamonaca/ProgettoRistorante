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
        Schema::create('dishes', function (Blueprint $table) {
            $table->id();

            $table->foreignId('category_id')
                ->constrained()
                ->cascadeOnDelete();

            $table->unsignedInteger('position')->default(0);
            $table->decimal('price', 8, 2)->nullable();
            $table->boolean('is_active')->default(true);

            // Nomi per lingua
            $table->string('name_it');
            $table->string('name_en')->nullable();
            $table->string('name_de')->nullable();
            $table->string('name_es')->nullable();
            $table->string('name_fr')->nullable();

            // Descrizioni per lingua
            $table->text('description_it')->nullable();
            $table->text('description_en')->nullable();
            $table->text('description_de')->nullable();
            $table->text('description_es')->nullable();
            $table->text('description_fr')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('dishes');
    }
};
