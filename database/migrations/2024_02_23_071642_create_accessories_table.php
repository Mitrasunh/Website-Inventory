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
        Schema::create('accessories', function (Blueprint $table) {
            $table->string('modelNumber',50);
            $table->string('category', 50); 
            $table->string('supplier', 50); 
            $table->date('purchase', 50); 
            $table->integer('qty'); 
            $table->string('notes', 250); 
            $table->string('image', 50); 
            $table->primary('modelNumber');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('accessories');
    }
};
