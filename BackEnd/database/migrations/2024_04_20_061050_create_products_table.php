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
            $table->id('product_id');
            $table->string('product_name');
            $table->decimal('product_price', total: 8, places: 2);
            $table->string('product_description');
            $table->timestamps();
        });

        DB::table('products')->insert([
            [
                'product_name'=>'soap',
                'product_price'=>'10.50',
                'product_description'=>'sabon ni.'
            ],
            [
                'product_name'=>'shampoo',
                'product_price'=>'15.75',
                'product_description'=>'shampoo ni.'
            ]
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
