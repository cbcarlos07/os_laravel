<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Template extends Model
{
    protected $table = "HAM_OS_TEMPLATE";
    public $primaryKey = "cd_template";
    public $timestamps = false;
}
