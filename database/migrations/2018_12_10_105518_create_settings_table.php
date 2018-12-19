<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('settings', function (Blueprint $table) {
            $table->increments('id');
            $table->string('site_en');
            $table->string('site_ar');
            $table->string('email');
            $table->string('lang')->default('ar');
            $table->string('logo')->nullable();
            $table->string('icon')->nullable();
            $table->text('description')->nullable();
            $table->longText('keywords')->nullable();
            $table->enum('status', ['open', 'close'])->default('open');
            $table->text('maintenance_msg')->nullable();
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
}
