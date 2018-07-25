<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Late extends Model
{
    protected $table='late';
    protected $primaryKey='lateId';
    public $timestamps=false;
}
