<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateValidationRulesTable extends Migration
{
    private $columns = ['title', 'required', 'email', 'password_length', 'file_size', 'password_confirm', 'reservation_min_time', 'reservation_exist'];

    public function up()
    {
        Schema::create('validation_rules', function (Blueprint $table) {
            $table->id();
            foreach ($this->columns as $column) $table->text($column)->nullable();
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
        Schema::dropIfExists('validation_rules');
    }
}
