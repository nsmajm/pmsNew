<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BriefItem extends Model
{
    protected $table='brief_item';
    protected $primaryKey='brief_itemId';
    public $timestamps=false;
}
