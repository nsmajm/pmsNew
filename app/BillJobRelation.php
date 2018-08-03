<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BillJobRelation extends Model
{
    protected $table='bill_job_relation';
    protected $primaryKey='bill_job_relationId';
    public $timestamps=false;
}
