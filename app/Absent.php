<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Absent extends Model
{
    protected $table='absent';
    protected $primaryKey='absentId';
    public $timestamps=false;
}
