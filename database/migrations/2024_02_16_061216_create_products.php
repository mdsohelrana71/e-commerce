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
            $table->string('url')->nullable();
            $table->string('title')->nullable();
            $table->longText('description')->nullable();
            $table->string('price')->nullable();
            $table->string('offer')->nullable();
            $table->string('shipping')->nullable();
            $table->integer('quantity')->nullable();
            $table->string('brand')->nullable();
            $table->integer('delivery_days')->nullable();
            $table->string('item_size')->nullable();
            $table->string('item_weight')->nullable();
            $table->string('item_color')->nullable();
            $table->string('materials')->nullable();
            $table->string('gender')->nullable();
            $table->string('ean')->nullable();
            $table->string('item_unit')->nullable();
            $table->integer('max_quantity_per_order')->nullable();
            $table->integer('status')->default(1);
            $table->integer('auth_id')->nullable();
            $table->string('meta_key')->nullable();
            $table->timestamp('created_at')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp('updated_at')->default(DB::raw('CURRENT_TIMESTAMP'));
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
