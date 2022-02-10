<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Subpages extends Model
{
    protected $table = 'subpages';

    protected $fillable = ['active', 'title', 'page', 'photo', 'photo_alt', 'order', 'meta_description'];
}
