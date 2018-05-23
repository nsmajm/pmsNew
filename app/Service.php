<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    protected $table='service';
    protected $primaryKey='serviceId';
    public $timestamps=false;
}
