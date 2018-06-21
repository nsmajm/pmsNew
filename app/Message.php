<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    protected $table='message';
    protected $primaryKey='messageId';
    public $timestamps=false;
}
