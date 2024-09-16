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
        Schema::create('user_accessories', function (Blueprint $table) {
            $table->string('nik',25);
            $table->string('username',50);
            $table->string('modelNumber',50);
            $table->string('category', 50); 
            $table->date('startDate');
            $table->boolean('status')->default(true);
            
            $table->foreign('nik')->references('nik')->on('employees');
            $table->foreign('modelNumber')->references('modelNumber')->on('accessories');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_accessories');
    }
};
