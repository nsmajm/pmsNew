<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Overtime extends Model
{
    protected $table='overtime';
    protected $primaryKey='overtimeId';
    public $timestamps=false;
}
