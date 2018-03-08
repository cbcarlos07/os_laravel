@extends('principal')
@section('title', 'Solicitar')
@section('content')



    <div class="modal fade " id="tela-ordem" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Status do Chamado</h4>
                </div>
                <div class="modal-body">



                    <div class="col-md-12" style="height: 600px; overflow: auto; font-size: small;">
                        <div class="form-group">
                            <label for="descos" class="col-md-4">Descri&ccedil;&atilde;o do Chamado:</label>
                            <div class="col-md-8">
                                <input class="form-control" id="descos">
                            </div>
                        </div>
                        <div class="row"></div>
                        <div class="form-group col-lg-12">
                            <label for="obs">Oberva&ccedil;&atilde;o</label>
                            <textarea id="obs" class="form-control"></textarea>
                        </div>

                        <div class="form-group">
                            <label for="nmusuario" class="col-md-4">Atendente:</label>
                            <div class="col-md-8">
                                <input class="form-control" id="nmusuario">
                            </div>
                        </div>
                        <div class="col-md-12"></div>
                        <div class="row "></div>
                        <div class="form-group">
                            <label for="status" class="col-md-4">Status:</label>
                            <div class="col-md-8">
                                <input class="form-control" id="status">
                            </div>
                        </div>

                        <div class="col-md-12"></div>
                        <div class="row "></div>

                        <div class="form-group col-md-12">
                            <label for="servicos">Servi&ccedil;os Realizados</label>
                            <div class="table" style="height: 150px; overflow: auto; font-size: small;">
                                <table class="table table-responsive table-hover">
                                    <thead>
                                    <th>Atendente</th>
                                    <th>Descri&ccedil;&atilde;o do Servi&ccedil;o</th>
                                    <th>Data</th>
                                    </thead>
                                    <tbody id="tbody-serv"></tbody>
                                </table>
                            </div>
                        </div>
                        <div class="row "></div>

                        <div class="form-group col-md-12">
                            <label for="servicos"><a href="#inf" class="lnk-add-inf">Adicionar Informa&ccedil;&otilde;es</a></label>
                            <div class="table" style="height: 150px; overflow: auto; font-size: small;">
                                <table class="table table-responsive table-hover table-inf">
                                    <thead id="theadInf"></thead>
                                    <tbody id="tbodyInf"></tbody>
                                </table>
                            </div>
                        </div>

                    </div>
                </div>
                <div class="row"></div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>

                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->



    <!-- Modal informações adicionais -->
    <div id="addInf" class="modal fade" role="dialog">
        <div class="modal-dialog">

            <!-- Modal content-->
            <div class="modal-content">
                <div class="linear-progress-material small load-modal">
                    <div class="bar bar1"></div>
                    <div class="bar bar2"></div>
                </div>
                <p class="alerta-modal"></p>
                <div class="modal-header">

                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Informa&ccedil;&otilde;es Adicionais</h4>
                </div>
                <div class="modal-body">
                    <div class="col-md-12">
                        <!-- 222 = No produção
                        -->
                        <div class="form-group ">
                            <input type="hidden" id="tempoHora">
                            <input type="hidden" id="tempoMinuto">
                            <input type="hidden" id="codigoItem">
                            <input type="hidden" id="resp" value="{{ Session::get('funcionario') }}">
                            <input type="hidden" id="servico" value="222">
                            <input type="hidden" id="datai">
                            <input type="hidden" id="dataf">
                            <input type="hidden" id="total">
                            <input type="hidden" id="codOs">
                        </div>

                        <div class="form-group col-lg-12">
                            <label for="desc">Descreva as informa&ccedil;&otilde;es que queira adicionar</label>
                            <textarea id="desc" class="form-control"></textarea>
                        </div>

                        <div class="row "></div>


                    </div>
                </div>
                <div class="row"></div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary btn-add-inf">Salvar</button>
                    <button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>
                </div>
            </div>

        </div>
    </div>



    <div class="col-md-8 " style="background: #ffffff">

      <div>
          <form class="formulario" action="{{ route('ordem.novaSolicitacao') }}" method="post">


                  <input type="hidden" id="cdsetor" />
                  <input type="hidden" value="{{ Session::get('login') }}" id="usuario" name="usuario" />
                  <input type="hidden" value="{{ Session::get('funcionario') }}" id="funcionario" />
                  <input type="hidden" value="{{ csrf_token() }}" name="_token" />
                  <div class="row"></div>
                  <div class="form-group ">
                      <label for="cdos" class="col-md-1 control-label">Cd OS</label>
                      <div class="col-md-2">
                          <input name="cdos" class="form-control" id="cdos" placeholder="C&oacute;d" disabled >
                      </div>
                  </div>

                  <div class="col-lg-12"></div>

                  <div class="form-group ">
                      <label for="solicitante" class="col-md-1 control-label">Solicitante<span style="color: red">*</span></label>
                      <div class="col-md-4">
                          <select  class="form-control" id="solicitante" name="solicitante" data-placeholder="Selecione o solicitante" tabindex="1" required="">
                              <option value=""></option>
                          </select>
                      </div>
                  </div>

                  <div class="form-group ">
                      <label for="setor" class="col-md-1 control-label">Setor</label>
                      <div class="col-md-6">
                          <select  class="form-control"  data-placeholder="Selecione o Setor" tabindex="2" id="setor" name="setor" required>
                              <option value=""></option>
                          </select>
                      </div>
                  </div>
                  <div class="col-lg-12"></div>
                  <div class="form-group ">
                      <label for="descricao" class="col-md-1 control-label">Descri&ccedil;&atilde;o</label>
                      <div class="col-md-8">
                          <input type="text" class="form-control" id="descricao" placeholder="Ex.: Impressora com problema"  tabindex="3" name="descricao" required=""/>
                      </div>
                  </div>
                  <div class="form-group ">
                      <label for="ramal" class="col-md-1 control-label">Ramal</label>
                      <div class="col-md-2">
                          <input type="text" class="form-control" id="ramal" placeholder="1404"  tabindex="4" name="ramal"/>
                      </div>
                  </div>
                  <div class="col-lg-12"></div>
                  <div class="form-group ">
                      <label for="observacao" class="col-md-1 control-label">Observa&ccedil;&atilde;o</label>
                      <div class="col-md-11">
                                  <textarea tabindex="5" id="observacao" name="osbervacao" class="form-control" required="" placeholder="Ex.: Impressora apresentando uma mensagem REPLACE TONER com uma luz vermelha intermitente (piscando)
    Meu IP: 192.168.1.1" ></textarea>
                      </div>
                  </div>
                  <br>

              <div class="row"></div>
              <div class="form-group col-md-5 btn-acoes">
                  <label for="inputEmail3" class="col-md-3 control-label"></label>
                  <button type="submit" class="btn btn-danger btn-salvar" ><i class="fa fa-save"></i></button>
                  <button class="btn btn-primary btn-limpar" ><i class="fa fa-paint-brush"></i></button>
                  <!--  <button class="btn btn-primary btn-template" ><i class="fa fa-folder-open"></i></button>-->
              </div>
          </form>
      </div>

      <div class="col-md-12">

          <h4>Minhas Solicita&ccedil;&otilde;es</h4>
          <hr />
          <div  style="height: 400px; overflow: auto; font-size: small;">
              <table class="table table-hover table-responsive tabela" >
                  <thead class="thead">
                  <th>#</th>
                  <th>Setor</th>
                  <th>Descri&ccedil;&atilde;o</th>
                  <th>Data Solicita&ccedil;&atilde;o</th>
                  <th>Status</th>
                  <th class='c1'></th>
                  </thead >
                  <tbody class="tbody">
                  </tbody>
              </table>
          </div>

      </div>
  </div>
  <div class="col-md-2" style="background: #ffffff;">
      <table class="table table-hover table-striped tabela-template">

      </table>
  </div>
@stop
@section('js')
    <script>


        $(document).ready( function () {
                var usuario = $('#usuario').val();
                carregarComboSolicitante();
                carregarComboSetor();
                carregarTabela( usuario );
                carregarTemplates();
                buscarLastSolicitante( usuario )
        } );

        function carregarComboSolicitante() {
            $.ajax({
                url : '{{ route('user.lista') }}',
                dataType : 'json',
                type : 'post',
                data : {
                    _token : '{{ csrf_token() }}'
                },
                success : function (data) {
                    //  console.log(data);
                    var option = "<option value='%'></opiton>";
                    $.each(data, function (i, j) {
                     //   console.log(j.cd_usuario);
                        option  += "<option value='"+j.cd_usuario+"'>"+j.nm_usuario+"</opiton>";
                    });
                    var combo = $('#solicitante');
                    combo.find('option').remove();
                    combo.append( option );
                    combo.chosen( {
                        allow_single_deselect: true,
                        search_contains: true,
                        no_results_text: "Nenhum resultado enontrado!"
                    } );
                    combo.val( $('#usuario').val() ).trigger('chosen:updated')
                }
            });
        }

        function carregarComboSetor() {
            $.ajax({
                url : '{{ route('setor.lista') }}',
                dataType : 'json',
                type : 'post',
                data : {
                    _token : '{{ csrf_token() }}'
                },
                success : function (data) {
                    //  console.log(data);
                    var option = "<option value='%'></opiton>";
                    $.each(data, function (i, j) {
                      //  console.log(j.cd_usuario);
                        option  += "<option value='"+j.cd_setor+"'>"+j.nm_setor+"</opiton>";
                    });
                    var combo = $('#setor');
                    combo.find('option').remove();
                    combo.append( option );
                    combo.chosen( {
                        allow_single_deselect: true,
                        search_contains: true,
                        no_results_text: "Nenhum resultado enontrado!"
                    } );
                    combo.trigger('chosen:updated')
                }
            });
        }


        function carregarTabela ( usuario ) {
            //$('#tabela').fadeOut('slow');




            $.ajax({
                url  : '{{ route('ordem.solicitada') }}',
                type : 'post',
                dataType : 'json',
                data : {
                    usuario : usuario,
                    _token  : '{{ csrf_token() }}'
                },
                success : function (data) {

                    var lines = "";
                    $.each(data, function (key, value) {
                        var cor = "";
                        //console.log("Chamado: "+value.cdos+" - Status: "+value.status);
                        if( value.status == 'C' ){
                            cor = "#E0F7FA";
                            //   console.log("Cor verde");

                        }

                        if( value.status == 'C' ){
                            lines += "<tr class='linha' bgcolor='"+ cor +"'>"
                                +"<td>" + value.cdos + "</td>"
                                +"<td>" + value.setor + "</td>"
                                +"<td>" + value.descricao + "</td>"
                                +"<td>" + value.pedido + "</td>"
                                +"<td>" + value.situacao + "</td>"
                                // +"<td><a href='#editar' title='Clique para editar' class='btn-lg' onclick='editar("+value.cdos+")'><i class='fa fa-pencil-square-o'></i></a></td>"
                                +"<td><a href='#servicos' title='Clique para visualizar' class='btn-lg btn-ver' data-id='"+value.cdos+"'><i class='fa fa-eye'></i></a></td>"
                                +"</tr>";
                        }else{
                            lines += "<tr class='linha' >"
                                +"<td>" + value.cdos + "</td>"
                                +"<td>" + value.setor + "</td>"
                                +"<td>" + value.descricao + "</td>"
                                +"<td>" + value.pedido + "</td>"
                                +"<td>" + value.situacao + "</td>"
                                // +"<td><a href='#editar' title='Clique para editar' class='btn-lg' onclick='editar("+value.cdos+")'><i class='fa fa-pencil-square-o'></i></a></td>"
                                +"<td><a href='#servicos' title='Clique para visualizar' class='btn-lg btn-ver' data-id='"+value.cdos+"'><i class='fa fa-eye'></i></a></td>"
                                +"</tr>";
                        }


                    });
                    $('.tbody').find('tr').remove();
                    $('.tbody').append(lines);

                    $('.btn-ver').on('click', function () {

                        var codigo = $( this ).data('id');
                        console.log( codigo );
                        ver( codigo );
                    });

                }

            });

        }


        var eachRow = "";
        function ver( codos ) {
            $('#codOs').val( "" );
            $('#descos').val("");
            $('#obs').val("");
            $('#nmusuario').val(0);
            $('#status').val(0);
            console.log( 'Codigo: '+codos );
            var tbody = $('#tbody-serv');
            tbody.find('tr').remove();
            var tabelaInf = $('.table-inf');
            var theadInf = $('#theadInf');
            var tbodyInf = $('#tbodyInf');
            theadInf.find('th').remove();
            tbodyInf.find('tr').remove();
            var nao = "";
            $.ajax({
                type : 'post',
                dataType: 'json',
                url  : '{{ route('ordem.getOs') }}',
                data : {
                    _token : '{{ csrf_token() }}',
                    cdos : codos
                },
                success : function (data) {
                    console.log( data );
                    $('#codOs').val( codos );
                    $('#descos').val(data.descricao);
                    $('#obs').val(data.observacao);
                    $('#nmusuario').val(data.atendente);
                    $('#status').val(data.status);

                    $.each(data.servicos, function (key, value) {
                        var hide = value.descricao;
                        var enc = hide.indexOf("#HIDE#");
                        // console.log("Nao: "+nao);
                        if( enc != 0 ){
                            eachRow = "<tr>"
                                +"<td>" + value.usuario + "</td>"
                                +"<td>" + value.descricao + "</td>"
                                +"<td>" + value.data + "</td>"
                                +"</tr>";
                        }

                        tbody.append(eachRow);
                    });
                    //  console.log(data.informacoes);
                    if( data.informacoes != ""){
                        //   console.log("Tipo de dado informaoces: "+ typeof data.informacoes );

                        theadInf.append(

                            "<th>Usu&aacute;rio</th><th>Descri&ccedil;&atilde;o</th><th>Data</th>"
                        );

                        $.each( data.informacoes, function ( i, j ) {
                            tbodyInf.append(
                                "<tr>"+
                                "<td>"+ j.usuario +"</td>"+
                                "<td>"+ j.descricao +"</td>"+
                                "<td>"+ j.data +"</td>"+
                                "<td> <a href='#editar' class='btn-editar'  title='Clique para alterar informa&ccedil;&atilde;o' onclick='abrirTelaAlterarServico("+ j.codigo +")'><i class='fa fa-pencil-square-o'></i></a>"+
                                "</tr>"
                            );
                        } );

                    }

                    tabelaInf.append( theadInf );
                    tabelaInf.append( tbodyInf );

                    $('#tela-ordem').modal('show');
                }
            });
        }

        function carregarTemplates(  ) {
            var tabela_templates = $('.tabela-template');
            tabela_templates.fadeOut( 'slow' );
            tabela_templates.find('tr').remove();
            $.ajax({
                url   : '{{ route('template.lista') }}',
                type  : 'post',
                dataType : 'json',
                data : {
                    _token : '{{ csrf_token() }}'
                },
                success : function (data) {
                    //console.log( data );
                    $.each( data, function (i, j) {
                        tabela_templates.append(
                            "<tr class='line-template'>" +
                            "<td><a href='#titulo' onclick='carregarTemplateNosCampos(" + j.cd_template + ")'>"+ j.ds_titulo +"</a></td>"+
                            //"<td class='td-remove'> <a href='#excluir'  title='Salvar exemplo' onclick='removerExemplo( " + j.codigo + ", \""+ j.titulo +"\" ) '><i class='fa fa-times'></i></a></td>"+
                            "</tr>"
                        );
                    } )

                    tabela_templates.fadeIn( 'slow' );

                }

            });
        }


        $('#descricao').on('input', function () {
            verificarCampo();
            if( $(this).val().length > 0 ){
                $(this).css( 'border-color', '' );
            }
        });

        $('#observacao').on('input', function () {
            verificarCampo();
            if( $(this).val().length > 0 ){
                $(this).css( 'border-color', '' );
            }
        });

        function verificarCampo() {

            var solicitante = $('#solicitante').val();
            var descricao   = $('#descricao').val();
            var observacao  = document.getElementById('observacao').value;
//    console.log("verificarCampo ");
            //   console.log("Solicitante: "+solicitante);
            if( ( solicitante != "") && (descricao.trim() != "")&& ( observacao.trim() != "" ) ){

                $('.btn-salvar').removeClass('btn-danger');
                $('.btn-salvar').addClass('btn-primary');
                enviar = true;

            }else{
                $('.btn-salvar').removeClass('btn-primary');
                $('.btn-salvar').addClass('btn-danger');
                enviar = false;
            }

        }



        $('#solicitante').on('change', function () {
            var value = $(this).chosen().val();
            //  console.log( "Mudou: "+value );
            buscarLastSolicitante( $(this).val() );
        });

        function buscarLastSolicitante( usuario ) {
            // var solicitante = $('#usuario').val();
            //var solicitante = $('#solicitante').val();

            //  console.log("Solicitante: "+usuario);
            //  $('#usuario').val( usuario );
            carregarTabela( usuario );
            var cdsetor = 0;
            $.ajax({
                url   : '{{ route('setor.ultimo') }}',
                dataType : 'json',
                type : 'post',
                data : {
                    _token      : '{{ csrf_token() }}',
                    solicitante : usuario
                },
                success : function (data) {

                    cdsetor =  data.cd_setor ;
                    $('#setor').val( cdsetor ).trigger("chosen:updated");


                    // console.log("Buscar last setor: "+cdsetor);

                    // carregarComboSetor( cdsetor );

                }
            });

            return cdsetor;

        }

        $('.lnk-add-inf').on('click', function () {

            $('#addInf').modal('show');

            carregarDataHoraAtualServico();

        });

        function carregarDataHoraAtualServico() {
            var agora = new Date();
            var options = { year: 'numeric', month: '2-digit', day: '2-digit' };
            var campoData = agora.toLocaleDateString("pt-BR", options)+' '+agora.toLocaleTimeString([], {hour: '2-digit', minute:'2-digit'});

            var dataHoraInicial = campoData.split(' ');
            var dataInicioStr   =  dataHoraInicial[0].split('/');
            var diaI = dataInicioStr[0];
            var mesI = dataInicioStr[1];
            var anoI = dataInicioStr[2];
            var horaInicialStr  = dataHoraInicial[1].split(':');
            var horaI = horaInicialStr[0];
            var minI  = horaInicialStr[1];
            var minII = parseInt(minI)  + 1;
            // console.log("Minuto: "+minII);
            var dataFinal = new Date(anoI, mesI-1, diaI, horaI, minII);
            var campoDataF = dataFinal.toLocaleDateString("pt-BR", options)+' '+dataFinal.toLocaleTimeString([], {hour: '2-digit', minute:'2-digit'});
            // console.log('Campo data: '+campoData);
            $('#datai').val(campoData);
            $('#dataf').val( campoDataF );
            //  $('#dataf').val( '' );

            calcularHoras();
        }


        function mensagemSucessoModal() {
            var mensagem = $('.alerta-modal');
            mensagem.empty().html('<p class="alert alert-success">Opera&ccedil;&atilde;o realizada com sucesso</p>').fadeIn("fast");
            setTimeout(function (){
                $('#addInf').modal('hide');
            },2000);
        }

        function calcularHoras () {

            try{
                var tempo = 0;
                var data1 = $('#datai').val().trim();
                //console.log("Data1; "+data1);
                var data2 = $('#dataf').val().trim();

                //console.log("Data inicio: '"+data1+"' Data fim: '"+data2+"'.");
                /** Transformando data hora inicial **/
                var dataHoraInicial = data1.split(' ');
                var dataInicioStr   =  dataHoraInicial[0].split('/');
                var diaI = dataInicioStr[0];
                //console.log("Dia inicial: "+diaI);
                var mesI = dataInicioStr[1];
                var anoI = dataInicioStr[2];
                var horaInicialStr  = dataHoraInicial[1].split(':');
                var horaI = horaInicialStr[0];
                var minI  = horaInicialStr[1];
                var dataInicial = new Date(anoI, mesI, diaI, horaI, minI);

                /** Transformando data hora final **/
                var dataHoraFinal = data2.split(' ');
                var dataFinalStr   =  dataHoraFinal[0].split('/');
                var diaf = dataFinalStr[0];
                var mesf = dataFinalStr[1];
                var anof = dataFinalStr[2];
                var horaFinalStr  = dataHoraFinal[1].split(':');
                var horaf = horaFinalStr[0];
                var minf  = horaFinalStr[1];
                var dataFinal = new Date(anof, mesf, diaf, horaf, minf);

                var diffMilissegundos  = dataFinal - dataInicial;
                tempo +=  diffMilissegundos;

                var diffSegundos = tempo / 1000;
                var diffMinutos = diffSegundos / 60;
                var diffHoras = Math.floor(diffMinutos / 60);
                var minutos = diffMinutos % 60;

                var horaStr = diffHoras;
                if( diffHoras < 10 ){
                    horaStr =  "0"+diffHoras;
                }

                var minStr = minutos;
                if( minutos < 10 ){
                    minStr = "0"+minutos;
                }

                var horas  = horaStr +":"+minStr;
                $( '#tempoHora ').val( horaStr );
                $( '#tempoMinuto' ).val( minStr );
                $( '#total' ).val( horas );
            }catch (err){
                //   console.log("Erro: "+err.message);
            }


        }


        $('.btn-add-inf').on('click', function () {
            salvarItem();
        });
        function aguardandoProcessamento() {
            $('.load-modal').fadeIn();
        }

        function salvarItem() {
            var codigoItem   =  $('#codigoItem').val();
            var horaFinal    =  $('#dataf').val();
            var horaInicio   =  $('#datai').val();
            var responsavel  =  $('#resp').val();
            var tempoHora    =  $('#tempoHora').val();
            var tempoMinuto  =  $('#tempoMinuto').val();
            var cdOs         =  $('#codOs').val();
            var servico      =  $('#servico').val();
            var descricao    =  $('#desc').val();
            var snfeito;//      =  document.getElementById('snfeito');
            //var snvisualiza      =  $('#snvisualiza');
            var feito        = "S";
            var acao         = "S";
            var url          = "{{ route('item.salvar') }}"
            //var checado = "Sn Visualiza nao chegado";
            /*if( snvisualiza.is(':checked') ){
                descricao = "#HIDE#"+descricao;
                checado = "Sn Visualiza chegado";
            }*/
            // console.log( checado );
            //   console.log("Data Final: "+horaFinal);
            /*if( snfeito.checked ){
             feito = "S"
             }*/



            if( codigoItem > 0 ){
                acao = "U";
            }


            //  console.log("Feito: "+feito);
            //  console.log("Codigo do funcionario: "+responsavel);

            $.ajax({
                url  : url,
                type : 'post',
                dataType : 'json',
                beforeSend : aguardandoProcessamento,
                data : {
                    _token      : '{{ csrf_token() }}',
                    horaFinal   : horaFinal,
                    horaInicio  : horaInicio,
                    tempoHora   : tempoHora,
                    cdOs        : cdOs,
                    funcionario : responsavel,
                    servico     : servico,
                    descricao   : descricao,
                    tempoMinuto : tempoMinuto,
                    feito       : feito,
                    codigo      : codigoItem,
                    acao        : acao
                },
                success : function (data) {
                    var retorno = data.retorno;
                    if( retorno > 0 ){
                        $('.load-modal').fadeOut('slow');
                        mensagemSucessoModal();
                        ver( cdOs );
                        $('#codigoItem').val( retorno )

                    }else{
                        $('.load-modal').fadeOut('slow');
                        msgErroModal('Ocorreu um erro ao realizar opera&ccedil;&atilde;o');
                    }
                }
            })



        }
    </script>
@stop