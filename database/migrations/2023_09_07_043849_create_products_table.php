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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->json('name');
            $table->json('description');
            $table->decimal('price', 14, 2);
            $table->decimal('basic_value', 14, 2);
            $table->integer('amount');
            $table->integer('discount_percentage')->nullable();
            $table->datetime('discount_start_datetime')->nullable();
            $table->datetime('discount_end_datetime')->nullable();
            $table->enum('status', ['sold', 'unsold'])->default('unsold');
            $table->foreignId('marketing_page_id')
                  ->constrained()
                  ->onUpdate('cascade')
                  ->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
