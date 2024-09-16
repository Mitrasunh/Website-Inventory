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
        Schema::create('user_assets', function (Blueprint $table) {
            $table->string('idAsset',25);
            $table->string('name', 50); 
            $table->string('brand',50);
            $table->string('type',50);
            $table->string('nik',25);
            $table->string('username',50);
            $table->boolean('status')->default(true);
            $table->date('startDate');
            $table->date('endDate');


            $table->foreign('idAsset')->references('idAsset')->on('assets');
            $table->foreign('nik')->references('nik')->on('employees');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_assets');
    }
};
