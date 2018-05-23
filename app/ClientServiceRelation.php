<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ClientServiceRelation extends Model
{
    protected $table='client_service_relation';
    protected $primaryKey='client_service_relationId';
    public $timestamps=false;
}
