<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BriefInstructions extends Model
{
    protected $table='brief_instructions';
    protected $primaryKey='brief_instructionsId';
    public $timestamps=false;
}
