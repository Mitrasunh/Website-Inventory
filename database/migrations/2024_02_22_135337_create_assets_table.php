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
        Schema::create('assets', function (Blueprint $table) {
            $table->string('idAsset',25);
            $table->string('name', 50); 
            $table->string('brand',50);
            $table->string('type',50);
            $table->string('processor', 50); 
            $table->string('ramCapacity', 50); 
            $table->string('storage', 50); 
            $table->string('operatingSystem', 50); 
            $table->string('supplier', 50); 
            $table->string('ipAddress1', 50); 
            $table->string('ipAddress2', 50); 
            $table->string('macAddress', 50); 
            $table->string('antivirus', 50); 
            $table->string('batteryHealth', 50); 
            $table->string('serialNumber', 50); 
            $table->date('purchase'); 
            $table->string('notes', 250);
            $table->string('image_path'); 
            $table->primary('idAsset');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('assets');
    }
};
