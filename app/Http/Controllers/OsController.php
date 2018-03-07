<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Validator;
class OsController extends Controller
{
    public function telaSolicitar(){
        return view('page.solicitar');
    }

    public function getOsSolicitadas( Request $request ){
        $solicitante = $request->input( 'usuario' );
        $query = "SELECT * FROM (
                      SELECT ROWNUM LINHA, OS_.* FROM (
                       SELECT OS.*, O.DS_OFICINA
                              ,TO_CHAR(OS.DT_PEDIDO, 'DD/MM/YYYY') DATA_PEDIDO
                              ,S.NM_SETOR 
                       FROM 
                             DBAMV.SOLICITACAO_OS OS
                            ,DBAMV.OFICINA O
                            ,DBAMV.SETOR   S 
                        WHERE OS.NM_SOLICITANTE = ?
                          AND OS.CD_OFICINA = O.CD_OFICINA
                          AND S.CD_SETOR = OS.CD_SETOR
                        ORDER BY OS.DT_PEDIDO DESC 
                      ) OS_  
                    ) OS
                    WHERE OS.LINHA > 0 AND LINHA < 6 ";
        $os = DB::select( $query, [ $solicitante ] );
        $tbody = array();
        foreach ( $os as $ordem ){
            $situacao = "Aguardando";
            if( $ordem->cd_responsavel != "" ){
                $situacao = "Em atendimento";
            }



            if( $ordem->tp_situacao == 'C' ){
                $situacao = "Concluída";
            }

            //  $situation = returnStatus($ordem->getSituacao()); //

            $tbody[] = array(
                "cdos"       => $ordem->cd_os,
                "setor"      => $ordem->nm_setor,
                "descricao"  => $ordem->ds_servico,
                "pedido"     => $ordem->data_pedido,
                "situacao"   => $situacao,
                "observacao" => $ordem->ds_observacao,
                "status"     => $ordem->tp_situacao

            );
        }


        return response()->json( $tbody );

    }

    public function getOs( Request $request ){
        $codigo = $request->input( 'cdos' );
       // echo "Item Solicitacao: ".$this->itemSolicitacao( $codigo );
        if( $this->itemSolicitacao( $codigo ) == 1 ){
                $query = "SELECT * FROM DBAMV.VIEW_HAM_GETSOLICITACAO V WHERE V.CODIGO = ?";
                $ordem = DB::select( $query, [ $codigo ] );

                $chamado['erro']          = 0;
                $chamado['pedido']        = $ordem[0]->data_pedido;
                $chamado['previsao']      = $ordem[0]->previsao;
                $chamado['solicitante']   = $ordem[0]->solicitante;
                $chamado['setor']         = $ordem[0]->codigo_setor;
                $chamado['tipoos']        = $ordem[0]->codigo_tipo_os;
                $chamado['motivo']        = $ordem[0]->codigo_motivo;
                $chamado['oficina']       = $ordem[0]->codigo_oficina;
                $chamado['descricao']     = $ordem[0]->servico;
                $chamado['observacao']    = $ordem[0]->observacao;
                $chamado['atendente']     = $ordem[0]->usuario;
                $chamado['ramal']         = $ordem[0]->ds_ramal;
                $chamado['status']        = $this->returnStatusAcento( $ordem[0]->situacao );
                $chamado['situacao']      = $ordem[0]->situacao;
                $chamado['servicos']      = $this->getListServico( $codigo);
                $chamado['informacoes']   = $this->getListServicoInf( $codigo );
                $chamado['resolucao']     = $ordem[0]->resolucao;
                $chamado['especialidade'] = $ordem[0]->codigo_espec;

                return response()->json( $chamado );
            }

    }

    private function itemSolicitacao( $codigo ){
        $retorno = false;
        $query = "SELECT * FROM VIEW_HAM_GETSOLICITACAO V WHERE V.CODIGO = ?";
        $os = DB::select( $query, [ $codigo ] );
        if( $os != null ){
            $retorno = true;
        }
        return $retorno;
    }

    private function returnStatusAcento( $status ){
        $retorno = "";

        switch ( $status ){
            case 'A':
                $retorno = "Aberta";
                break;
            case 'C':
                $retorno = "Concluída";
                break;
            case 'D':
                $retorno = "Cancelada";
                break;
            case 'E':
                $retorno = "Conserto Externo";
                break;
            case 'N':
                $retorno = "Não Atendida";
                break;
            case 'M':
                $retorno = "Aguardando Material";
                break;

            case 'S':
                $retorno = "Solicitação";
                break;
            case 'L':
                $retorno = "Aguardando Liberação do Setor";
                break;
            case 'F':
                $retorno = "Agendar";
                break;

        }
        return $retorno;
    }

    function getListServico( $cdOs ){

        $query = "SELECT * FROM DBAMV.VIEW_HAM_LISTA_ITOS V WHERE V.CD_OS = ?";
        $itens = DB::select( $query, [ $cdOs ] );
        $servicos = array();
        foreach ( $itens as $item ){
            $hide = "#HIDE#";
            $texto = $item->ds_servico;
            $post = strripos( $texto, $hide );
            if( $post == false ){
                $servicos[] = array(
                    "usuario"   => $item->nm_func,
                    "servico"   => $item->nm_servico,
                    "descricao"   => $item->ds_servico,
                    "data"      => $item->inicio,

                );
            }
        }
        return $servicos;
    }

    function getListServicoInf( $cdOs ){
        $query = "SELECT * FROM DBAMV.VIEW_HAM_LISTA_ITOS_INF V WHERE V.CD_OS = ?";
        $itens = DB::select( $query, [ $cdOs ] );
        $servicos = array();
        foreach ( $itens as $item ){
            $hide = "#HIDE#";
            $texto = $item->ds_servico;
            $post = strripos( $texto, $hide );

            if( $post == false ){
                $servicos[] = array(
                    "codigo"    => $item->cd_itsolicitacao_os,
                    "usuario"   => $item->nm_func,
                    "servico"   => $item->nm_servico,
                    "descricao" => $item->ds_servico,
                    "data"      => $item->inicio,

                );
            }

        }
        return $servicos;

    }

    public function salvar( Request $request ){

        $solicitante = $request->input( 'solicitante' );
        $usuario     = $request->input( 'usuario' );
        $setor       = $request->input( 'setor' );
        $descricao   = $request->input( 'descricao' );
        $ramal       = $request->input( 'ramal' );
        $observacao  = $request->input( 'observacao' );
        $codigo      = $this->proxRegistro();

        $sql = "insert into abertura_chamado 
                 (cd_os, dt_pedido, ds_servico, ds_observacao, nm_solicitante,TP_SITUACAO, CD_SETOR,
                  CD_MULTI_EMPRESA, CD_TIPO_OS, NM_USUARIO, DT_ULTIMA_ATUALIZACAO,
                  SN_SOL_EXTERNA, CD_OFICINA, SN_ORDEM_SERVICO_PRINCIPAL, 
                  SN_PACIENTE, DT_ENTREGA, TP_PRIORIDADE, SN_RECEBIDA,  SN_ETIQUETA_IMPRESSA,
                  SN_EMAIL_ENVIADO, TP_CLASSIFICACAO, CD_ESPEC, DS_RAMAL, TP_LOCAL
                 )
                 values 
                ( ?, SYSDATE, ?, ?, ?, 'S', ?, 
                 1, 30, ? , SYSDATE , 
                 'S', 14, 'S',  
                 'N', SYSDATE , ?, 'N',  'N',
                 'N',  'P', 31, ?, 'I')";
        $prioridade = 'E';
        $campos = array(
             $codigo,
             $descricao,
             $observacao,
             $solicitante,
             $setor,
             $usuario,
             $prioridade,
             $ramal

        );


        DB::insert( $sql, $campos );


    }

    private function proxRegistro(){
        $codigo = 0;

        $sql = "SELECT SEQ_OS.NEXTVAL CODIGO FROM DUAL";

        $codigo = DB::select( $sql );

        return $codigo;
    }

}
