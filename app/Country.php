<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
    protected $table='country';
    protected $primaryKey='countryId';
    public $timestamps=false;
}
