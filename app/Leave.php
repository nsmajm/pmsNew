<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Leave extends Model
{
    protected $table='leave';
    protected $primaryKey='leaveId';
    public $timestamps=false;
}
