<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('registers', function (Blueprint $table) {
            $table->id();
            // For Customer
            $table->longText('customer_register_description_en');
            $table->longText('customer_register_description_ar');
            $table->longText('customer_register_image')->nullable();
            $table->longText('customer_register_video_cover')->nullable();
            $table->longText('customer_register_video')->nullable();

            // For Store
            $table->longText('store_register_description_en');
            $table->longText('store_register_description_ar');
            $table->longText('store_register_image')->nullable();
            $table->longText('store_register_video_cover')->nullable();
            $table->longText('store_register_video')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('registers');
    }
};
