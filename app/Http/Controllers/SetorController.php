<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
class SetorController extends Controller
{
    public function getListaSetor(){
        $query = "SELECT * FROM DBAMV.SETOR S ORDER BY S.NM_SETOR";
        $setor = DB::select( $query );
        return response()->json( $setor );
    }

    public function getDadosUltimoSolicitante( Request $request ){
        $id = $request->input( 'solicitante' );
        $sql =   "  SELECT  OS.CD_SETOR 
                            ,S.NM_SETOR
                       FROM SOLICITACAO_OS OS
                           ,SETOR          S
                      WHERE OS.NM_SOLICITANTE = ?
                      AND   OS.CD_SETOR = S.CD_SETOR
                   ORDER BY OS.DT_PEDIDO DESC";
        $setor = DB::select( $sql, [ $id ] );

        return response()->json( $setor[0] );
    }
}
