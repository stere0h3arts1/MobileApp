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
        Schema::create('subjects', function (Blueprint $table) {
            $table->id('sub_id');
            $table->string('subject_code');
            $table->decimal('description');
            $table->string('units');
            $table->timestamps();
        });

        DB::table('subject')->insert([
            [
                'subject_code'=>'46554',
                'description'=>'Math',
                'units'=>'5'
            ],
            [
                'subject_code'=>'123312',
                'description'=>'English',
                'units'=>'6'
            ]
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('subjects');
    }
};
