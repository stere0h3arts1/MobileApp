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
            $table->id('user_id');
            $table->string('username')->unique();
            $table->string('email')->unique();
            $table->string('password');
            $table->string('fullname');
            $table->string('token');
            $table->timestamps();
        });

        DB::table('users')->insert([
            [
                'username'=>'juan',
                'email'=>'juan',
                'password'=>'*884B2932FBF0CA266EC48EE05A3DA15388FA7E3E',
                'fullname'=>'Juan Dela Cruz',
                'token'=>''
            ],
            [
                'username'=>'pedro',
                'password'=>'*0CD5B5852B8E5B4131BD24FB9A1AA1D521399A64',
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
