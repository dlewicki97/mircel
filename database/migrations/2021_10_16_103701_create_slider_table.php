<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSliderTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('slider', function (Blueprint $table) {
            $table->id();
            $table->text('title')->nullable();
            $table->text('subtitle')->nullable();
            $table->text('button_name_1')->nullable();
            $table->text('button_link_1')->nullable();
            $table->text('button_name_2')->nullable();
            $table->text('button_link_2')->nullable();
            $table->text('photo')->nullable();
            $table->text('photo_alt')->nullable();
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
        Schema::dropIfExists('slider');
    }
}
