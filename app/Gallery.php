<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Gallery extends Model
{
    protected $table = 'gallery';

    protected $fillable = ['path', 'table_name', 'item_id', 'photo_alt'];
}
