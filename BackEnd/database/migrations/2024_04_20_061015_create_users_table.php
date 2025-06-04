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
        Schema::create('users', function (Blueprint $table) {
            $table->id('userid');
            $table->string('username');
            $table->string('password');
            $table->string('fullname');
            $table->string('token');
            $table->timestamps();
        });

        DB::table('users')->insert([
            [
                'username'=>'juan',
                'password'=>'$2y$12$dN.6DGvwzgR47FiOfHs96OxlEYw4xE3k4TBMyvutDOPjm7az3ug2S',
                'fullname'=>'Juan Dela Cruz',
                'token'=>''
            ],
            [
                'username'=>'pedro',
                'password'=>'$2y$12$acAvixOX57POtE5iAZV0ge8C5L9dyG7IIgsALQEEVRURDemNw4Zou',
                'fullname'=>'Pedro Pendoko',
                'token'=>''
            ]
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
