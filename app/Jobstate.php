<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Jobstate extends Model
{
    protected $table='jobstate';
    protected $primaryKey='jobstateId';
    public $timestamps=false;
}
