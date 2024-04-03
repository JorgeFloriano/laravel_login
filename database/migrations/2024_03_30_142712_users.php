<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
   
    public function up(): void
    {
        Schema::create('users', function(Blueprint $table) {
            $table->id();
            $table->string('user', 50);
            $table->string('pass', 200);
            $table->dateTime('last_loguin')->nullable();
            $table->tinyInteger('active')->default(1);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    
    public function down(): void
    {
        Schema::drop('users');
    }
};
