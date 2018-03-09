<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
class ItemSolicitacaoServicoController extends Controller
{
    public function salvarItemOS( Request $request ){

        $hinicio    = $request->input( 'horaInicio' );
        $horaFinal  = $request->input( 'horaFinal' );
        $tempo      = $request->input( 'tempoHora' );
        $cdOs       = $request->input( 'cdOs' );
        $func       = $request->input( 'funcionario' );
        $servico    = $request->input( 'servico' );
        $descricao  = $request->input( 'descricao' );
        $minuto     = $request->input( 'tempoMinuto' );
        $feito      = $request->input( 'feito' );
        $codigo     = $this->getItOs();


        if( isset( $horaFinal ) ){
          //  echo "Possui hora final";
            $query = "insert into DBAMV.ITSOLICITACAO_OS 
                 (CD_ITSOLICITACAO_OS,HR_FINAL, HR_INICIO,  VL_TEMPO_GASTO, CD_OS,
                 CD_FUNC, CD_SERVICO, DS_SERVICO, VL_TEMPO_GASTO_MIN, SN_CHECK_LIST,
                 VL_HORA, VL_HORA_EXTRA )
                 VALUES
                 (?, TO_DATE(?, 'DD/MM/YYYY HH24:MI:SS'), TO_DATE(?, 'DD/MM/YYYY HH24:MI:SS'), ?, ?,  
                 ?, ?, ?, ?, ?,
                 0,0 ) ";
            $dados = array(
                $codigo ,
                $horaFinal,
                $hinicio,
                $tempo,
                $cdOs,
                $func ,
                $servico,
                $descricao,
                $minuto ,
                $feito

            );
        }else{
           // echo "Nao possui hora final";
            $query = "INSERT INTO DBAMV.ITSOLICITACAO_OS 
                 (CD_ITSOLICITACAO_OS,HR_FINAL, HR_INICIO,  VL_TEMPO_GASTO, CD_OS,
                 CD_FUNC, CD_SERVICO, DS_SERVICO, VL_TEMPO_GASTO_MIN, SN_CHECK_LIST,
                 VL_HORA, VL_HORA_EXTRA )
                 VALUES
                 (?, TO_DATE(?, 'DD/MM/YYYY HH24:MI:SS'), ?, ?,  
                 ?, ?, ?, ?, ?,
                 0,0 ) ";
            $dados = array(
                $codigo,
                $hinicio,
                $tempo,
                $cdOs,
                $func,
                $servico,
                $descricao,
                $minuto,
                $feito
            );
        }

        $retorno = DB::insert( $query, $dados );
        return response()->json( array( 'retorno' => $retorno ) );


    }

    public function getItOs(){
        $sql = "SELECT SEQ_ITOS.NEXTVAL CODIGO FROM DUAL";
        $obj = DB::select( $sql );
        return $obj[0]->codigo;
    }
}
