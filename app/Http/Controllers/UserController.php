<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Session;
use Illuminate\Support\Facades\Input;
class UserController extends Controller
{
    public function telaLogin(){
        return view('login');
    }

    public function getEmpresa( Request $request ){

        $login =  strtoupper( $request->input( 'usuario' ) );
        $query = "SELECT M.DS_MULTI_EMPRESA 
                      FROM DBAMV.USUARIO_MULTI_EMPRESA E
                          ,DBAMV.MULTI_EMPRESAS        M
                          ,DBASGU.USUARIOS             U
                     WHERE U.CD_USUARIO = ?
                       AND E.CD_MULTI_EMPRESA = M.CD_MULTI_EMPRESA
                       AND E.CD_ID_USUARIO = U.CD_USUARIO     ";
        $empresa = DB::select( $query, [ $login ] );

        //  dd($empresa);

        return response()->json( [ $empresa ]);
    }

    public function logar( Request $request ){

        $login = strtoupper( $request->input( 'login' ) );
        $senha = strtoupper( $request->input( 'senha' ) );
        $empresa = strtoupper( $request->input( 'empresa' ) );

        $query = "SELECT DBAADV.SENHAUSUARIOMV(?) SENHA FROM DUAL";
        $pwd = DB::select( $query, [ $login ] );
     //   echo "Login: ".$login;

        if( $pwd[0]->senha == $senha ){

            $query = "SELECT * FROM V_TI_PAPEL V WHERE V.USUARIO  = ?";
            $papel = DB::select( $query, [ $login ] );

            $query = "SELECT F.CD_FUNC FROM DBAMV.FUNCIONARIO F WHERE F.NM_FUNC = ?";
            $cdFunc = DB::select( $query, [ $login ] );
            echo "Codigo func: ".$cdFunc[0]->cd_func;
            Session::put([
                'login'        => $login,
                'sistema'      => $papel[0]->papel,
                'funcionario'  => $cdFunc[0]->cd_func
            ]);
            return redirect()->route('os.solicitar');
        }else{
            $msg = array(
                'senha' => 'Parece que sua senha não está correta'
            );
         //   echo "Erro";
            return redirect()->back()->withErrors( $msg )->withInput(Input::except('senha'));
        }
    }

    public function getListaUsuarios(){
        $query = "SELECT * 
                     FROM DBASGU.USUARIOS U
                     WHERE U.SN_ATIVO = 'S'
                     ORDER BY 1";
        $usuario = DB::select( $query );

        return response()->json( $usuario );
    }
}
