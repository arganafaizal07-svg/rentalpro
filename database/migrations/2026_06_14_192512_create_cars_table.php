<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('cars', function (Blueprint $table) {
            $table->id();

            $table->string('name');
            $table->string('brand');
            $table->string('category');
            $table->integer('year');

            $table->text('description')->nullable();

            $table->decimal('price', 12, 2);

            $table->enum('transmission', [
                'Automatic',
                'Manual'
            ]);

            $table->enum('fuel_type', [
                'Petrol',
                'Diesel',
                'Hybrid',
                'Electric'
            ]);

            $table->integer('seats');

            $table->enum('status', [
                'Available',
                'Unavailable',
                'Maintenance'
            ])->default('Available');

            $table->string('image')->nullable();

            $table->text('features')->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('cars');
    }
};