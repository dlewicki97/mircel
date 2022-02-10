<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Mails extends Model
{
    protected $table = 'mails';

    protected $fillable = ['phone', 'email', 'message', 'subject', 'name', 'rodo1', 'rodo2', 'attachment', 'answer', 'answer_message'];

    protected $hidden = ['file'];

    public function attachments() {
    	return $this->hasMany('App\Attachments', 'mail_id');
    }
}
