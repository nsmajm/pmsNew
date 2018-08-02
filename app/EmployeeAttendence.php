<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EmployeeAttendence extends Model
{
    protected $table='employeeattendence';
    protected $primaryKey='id';
    public $timestamps=false;
}
