<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Team extends Model
{
    protected $table='team';
    protected $primaryKey='team Id';
    public $timestamps=false;
}
