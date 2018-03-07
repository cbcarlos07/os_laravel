<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OrdemServico extends Model
{
    protected $table = 'DBAMV.SOLICITACAO_OS';
    public $primaryKey = 'CD_OS';
    public $timestamps = false;
}
