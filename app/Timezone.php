<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Timezone extends Model
{
    protected $table='timezone';
    protected $primaryKey='timezoneId';
    public $timestamps=false;
}
