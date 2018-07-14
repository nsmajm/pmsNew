<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserType extends Model
{
    protected $table='usertype';
    protected $primaryKey='id';
    public $timestamps=false;
    public $incrementing = false;
}
