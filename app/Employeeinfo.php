<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Employeeinfo extends Model
{
    protected $table='employee_info';
    protected $primaryKey='empId';
    public $timestamps=false;
}
