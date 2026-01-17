<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAboutsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('abouts', function (Blueprint $table) {
            $table->increments('id');
            $table->text('caption');
            $table->string('image');
            $table->timestamps();
            $table->string('hero_bg')->nullable(); // Foto background hero
            $table->string('whatsapp')->nullable();
            $table->string('jam_operasional')->nullable();
            $table->text('alamat')->nullable();
            $table->string('footer_text')->nullable();
            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('abouts');
    }
}
