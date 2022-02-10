<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PasswordResets extends Model
{
    protected $guarded = ['id'];
    const UPDATED_AT = null;
}
