<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Example extends Model
{
	protected $guarded = ['id'];
	protected $table = "{table}";
}
