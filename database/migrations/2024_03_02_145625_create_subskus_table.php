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
        Schema::create('subskus', function (Blueprint $table) {
            $table->id();
            $table->string('product_id');
            $table->string('sku');
            $table->string('name');
            $table->string('sup_id');
            $table->string('colour');
            $table->string('image');
            $table->string('t_price');
            $table->string('r_price');
            $table->string('size');
            $table->string('qty');
            $table->string('status');
            $table->string('description');
            $table->string('location');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('subskus');
    }
};
