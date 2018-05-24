<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Brief extends Model
{
    protected $table='brief';
    protected $primaryKey='briefId';
    public $timestamps=false;
}
