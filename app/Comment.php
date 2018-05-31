<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $table='comment';
    protected $primaryKey='commentId';
    public $timestamps=false;
}
