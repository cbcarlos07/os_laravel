<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TipoOs extends Model
{
    protected $table = "tipo_os";
    public $primaryKey = "cd_tipo_os";
    public $timestamps = false;
}
