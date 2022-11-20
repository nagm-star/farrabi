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
        Schema::create('settings', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('name_en');
            $table->mediumText('key');
            $table->mediumText('key_en');
            $table->mediumText('description');
            $table->mediumText('description_en');
            $table->string('contact_number');
            $table->string('email'); 
            $table->string('address');
            $table->string('image');
            $table->string('facebook');
            $table->string('twitter');
            $table->string('youtube');
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
        Schema::dropIfExists('settings');
    }
};
