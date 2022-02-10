<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SolarSystem extends Model
{
	protected $guarded = ['id'];
	protected $table = "solar_system";
}
