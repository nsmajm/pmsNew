<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class JobServiceRelation extends Model
{
    protected $table='job_service_relation';
    protected $primaryKey='job_service_relationId';
    public $timestamps=false;
}
