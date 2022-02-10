<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Opinions extends Model
{
	protected $guarded = ['id'];
	protected $table = "opinions";
}
