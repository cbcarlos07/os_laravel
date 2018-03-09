@extends('principal')

@section('title', 'Chamados')
@section('css')
    <link href="{{ URL('css/jquery.datetimepicker.min.css') }}" >
@stop
@section('content')
    <div class="col-md-8 " style="background: #ffffff">

        <div class="col-md-11">
            <form class="formulario">

                <input type="hidden"  id="cdsetor" />
                <input type="hidden" value="{{ Session::get('login') }}" id="usuario" />
                <input type="hidden" value="{{ Session::get('funcionario') }}" id="funcionario" />
                <div class="col-md-12"></div>


                <div class="form-group ">
                    <label for="cdos" class="col-md-1 control-label">Cd OS</label>
                    <div class="col-md-2">
                        <input type="text" class="form-control" id="cdos" placeholder="C&oacute;d" disabled value="{{ $codigo }}">
                    </div>
                </div>

                <div class="form-group ">
                    <label for="dataos" class="col-md-1 control-label">Data Os</label>
                    <div class="col-md-3">
                        <input type="text" class="form-control" id="dataos" disabled>
                    </div>
                </div>

                <div class="form-group ">
                    <label for="previsao" class="col-md-2 control-label" title="Previs&atilde;o de entrega">Prev de Entrega</label>
                    <div class="col-md-3">
                        <input type="text" class="form-control" id="previsao" >
                    </div>
                </div>

                <div class="col-md-12"></div>

                <div class="form-group ">
                    <label for="solicitante" class="col-md-1 control-label">Solicitante</label>
                    <div class="col-md-2">
                        <input type="email" class="form-control" id="solicitante" placeholder="NOME.SOBRENOME"  disabled>
                    </div>
                </div>

                <div class="form-group ">
                    <label for="setor" class="col-md-1 control-label">Setor<span style="color: red">*</span></label>
                    <div class="col-md-4">
                        <select  class="form-control"  data-placeholder="Selecione o Setor" tabindex="2" id="setor" >
                            <option value="0"></option>
                        </select>
                    </div>
                </div>

                <div class="col-md-12"></div>



                <div class="form-group ">
                    <label for="tipoos" class="col-md-1 control-label">Tipo OS</label>
                    <div class="col-md-3">
                        <select  class="form-control"  tabindex="2" id="tipoos" data-placeholder="Selecione o tipo de Os">
                            <option value="0"></option>
                        </select>
                    </div>
                </div>

                <div class="form-group ">
                    <label for="motivo" class="col-md-1 control-label">Motivo</label>
                    <div class="col-md-3">
                        <select  class="form-control"  data-placeholder="Selecione o Motivo" tabindex="2" id="motivo" >
                            <option value="0"></option>
                        </select>
                    </div>
                </div>


                <div class="form-group ">
                    <label for="oficina" class="col-md-1 control-label">Oficina</label>
                    <div class="col-md-3">
                        <select  class="form-control"  tabindex="2" id="oficina" data-placeholder="Selecione a oficina">
                            <option value="0"></option>
                        </select>
                    </div>
                </div>

                <div class="col-lg-12"></div>

                <div class="form-group ">
                    <label for="descricao" class="col-md-1 control-label">Descri&ccedil;&atilde;o</label>
                    <div class="col-md-8">
                        <input type="text" class="form-control" id="descricao" placeholder="Ex.: Impressora com problema" onblur="verificarCampo()" disabled/>
                    </div>
                </div>
                <div class="form-group ">
                    <label for="ramal" class="col-md-1 control-label">Ramal</label>
                    <div class="col-md-2">
                        <input type="text" class="form-control" id="ramal" placeholder="1404"  />
                    </div>
                </div>
                <div class="col-md-12"></div>
                <div class="form-group ">
                    <label for="observacao" class="col-md-1 control-label">Observa&ccedil;&atilde;o<span style="color: red">*</span></label>
                    <div class="col-md-11">
                        <textarea id="observacao" class="form-control" placeholder="Ex.: Impressora apresentando uma mensagem REPLACE TONER com uma luz vermelha intermitente (piscando)" ></textarea>
                    </div>
                </div>
                <div class="col-md-12"></div>
                <div class="form-group ">
                    <label for="responsavel" class="col-md-1 control-label" title="Respons&aacute;vel">Respons&aacute;vel<span style="color: red">*</span></label>
                    <div class="col-md-3">
                        <select  class="form-control"  tabindex="2" id="responsavel" data-placeholder="Selecione o respons&aacute;vel">
                            <option value="0"></option>
                        </select>
                    </div>
                </div>

                <div class="form-group ">
                    <label for="status" class="col-md-1 control-label">Status</label>
                    <div class="col-md-3">
                        <select  class="form-control"  tabindex="2" id="status" >
                            <option value="A">Aberto</option>
                            <option value="C">Conclu&iacute;do</option>
                            <option value="N">N&atilde;o Atendido</option>
                            <option value="M">Aguardando Material</option>
                            <option value="E">Conserto Externo</option>
                            <option value="S">Solicita&ccedil;&atilde;o</option>
                            <option value="L">Aguardando Libera&ccedil;&atilde;o do Setor</option>
                            <option value="F">Agendar</option>
                            <option value="D">Cancelada</option>
                        </select>
                    </div>
                </div>

                <div class="form-group ">
                    <label for="resolucao" class="col-md-1 control-label" title="Resolu&ccedil;&atilde;o Final">Res. Final</label>
                    <div class="col-md-3">
                        <input type="text" class="form-control" id="resolucao" placeholder="Ex.: Atendimento finalizado com sucesso" tabindex="3">
                    </div>
                </div>

                <br>
            </form>
        </div>
        <div class="form-group col-md-5 btn-acoes">
            <label for="inputEmail3" class="col-md-3 control-label"></label>
            <button class="btn btn-primary btn-salvar" ><i class="fa fa-save"></i></button>
            <button class="btn btn-primary btn-limpar" ><i class="fa fa-paint-brush"></i></button>
        </div>
        <div class="col-md-10">

            Servi&ccedil;o <button class="btn-xs btn btn-danger btn-servico" title="Adicionar servi&ccedil;o" ><i class="fa fa-plus"></i></button>
            <hr />
        </div>
        <table class="table table-hover table-responsive tabela table-striped" >
            <thead class="thead">
               <tr>
                   <th>Servi&ccedil;o</th>
                   <th>Funcion&aacute;rio</th>
                   <th>Descri&ccedil;&atilde;o</th>
                   <th>Data In&iacute;cio</th>
                   <th>Data Final</th>
                   <th>Tempo Total</th>
                   <th class='c1'></th>
               </tr>
            </thead >
            <tbody class="tbody">
            </tbody>
        </table>


    </div>
@stop

@section('js')
    <script>
        $(document).ready(function () {
            $(window).load(function () {
                $('.loading').fadeOut();
                getOs();
            })
        })

        function getOs(  ) {
            var _cdOs = $('#cdos').val();
            $.ajax({
                url   : '{{ route('os.telaCadastro') }}',
                type  : 'post',
                dataType : 'json',
                data  : {
                    _token : '{{ csrf_token() }}',
                    cdos : _cdOs
                },
                success : function (data) {
                    //  console.log("Seetor: "+data.setor);
                    var tipoos = data.tipo_os;
                    carregarComboMotivo( tipo_os );
                    carregarComboTipoOs( tipo_os );
                    carregarComboResponsavel( data.oficina, usuario );

                    $('#dataos').val(data.data_pedido);
                    $('#previsao').val(data.previsao);
                    //    $('#setor').val(  ).trigger("chosen:updated");
                    carregarComboSetor( data.cd_setor );
                    $('#descricao').val( data.servico );
                    $('#ramal').val( data.ramal );
                    $('#observacao').val( data.observacao );
                    $('#solicitante').val( data.solicitante );
                    $('#oficina').val(data.codigo_oficina).trigger("chosen:updated");
                    $('#responsavel').val(data.responsavel).trigger("chosen:updated");


                    verificarCampoChamado();
                    preencherTabelaServicos();
                    // console.log("Tipo OS: "+tipoos);

                }
            });
        }


        function carregarComboTipoOs( tipoOs ){
            $.ajax({
                url      : 'funcao/tipoos.php',
                type     : 'post',
                dataType : 'json',
                data : {
                    acao : 'T'
                },
                success : function (data) {

                    $.each( data.tipoos, function (key, value) {

                        var option  = "<option value='"+ value.codigo +"'>"
                            + value.descricao
                            +"</option> ";

                        $('#tipoos').append(option);

                    } );

                    $('#tipoos').val( tipoOs ).trigger("chosen:updated");;
                }

            });

        }

        function carregarComboMotivo( tipoOs ){
            var comboMotivo = $('#motivo');
            comboMotivo.find('option').remove();
            $.ajax({
                url      : 'funcao/tipoos.php',
                type     : 'post',
                dataType : 'json',
                data : {
                    acao   : 'M',
                    tipoos : tipoOs
                },
                success : function (data) {

                    $.each( data.motivos, function (key, value) {

                        var option  = "<option value='"+ value.codigo +"'>"
                            + value.descricao
                            +"</option> ";

                        comboMotivo.append(option);

                    } );

                    comboMotivo.trigger("chosen:updated");
                }

            });

        }

        function carregarComboResponsavel( oficina, usuario ){
            $.ajax({
                url      : 'funcao/responsavel.php',
                type     : 'post',
                dataType : 'json',
                data : {
                    acao   : 'R',
                    oficina : oficina
                },
                success : function (data) {
                    /*var op = "<option value='0'>Selecione</option>";
                    $('#responsavel').append(op);*/
                    // console.log(data);
                    $.each( data.usuarios, function (key, value) {

                        var option  = "<option value='"+ value.cdusuario +"'>"
                            + value.cdusuario
                            +"</option> ";

                        $('#responsavel').append(option);

                    } );
                    $('#responsavel').val( usuario ).trigger("chosen:updated");
                }

            });




        }

        function carregarComboFuncionario( especialidade, funcionario ){
            var resp = $('#resp');
            resp.find('option').remove();
            $.ajax({
                url      : 'funcao/responsavel.php',
                type     : 'post',
                dataType : 'json',
                data : {
                    acao   : 'F',
                    especialidade : especialidade
                },
                success : function (data) {
                    var op = "<option value='0'></option>";
                    resp.append(op);
                    // console.log(data);
                    $.each( data.funcionarios, function (key, value) {

                        var option  = $('<option>').val( value.codigo ).text( value.nome ) ;

                        resp.append(option);

                    } );
                    resp.val( funcionario ).trigger("chosen.updated")
                }

            });

        }

        function carregarComboServico(  ){
            $.ajax({
                url      : 'funcao/servico.php',
                type     : 'post',
                dataType : 'json',
                data : {
                    acao   : 'M'
                },
                success : function (data) {
                    var op = $("<option>").val(0);
                    $('#servico').append(op);
                    // console.log(data);
                    $.each( data.servicos, function (key, value) {

                        var option  = $('<option>').val( value.codigo ).text( value.servico ) ;

                        $('#servico').append(option);

                    } );
                    $('#servico').trigger("chosen:updated");

                }

            });

        }

        function verificarCampoChamado() {
            var setor      =    $('#setor').val();
            var descricao   =    $('#descricao').val();
            var responsavel =    $('#responsavel').val();
            var observacao  =    $('#observacao').val();
            var btn = $('.btn-servico');
            var btnSalvar = $('.btn-salvar');
            //   console.log( 'observacao: '+observacao );
            if( ( setor != 0) && ( descricao != "" ) && ( observacao != "" ) && ( responsavel != 0 ) ){
                boolNovoServico = true;
                btnSalvar.removeClass('btn-danger');
                btnSalvar.addClass('btn-primary');
                btn.removeClass('btn-danger');
                btn.addClass('btn-primary');
                btnSalvar.attr("title","Pronto para salvar");
                btn.attr("title","Permite adicionar novo servico");
            }else{

                btn.attr("title","Preencha todos campos obrigatorios");
                btnSalvar.attr("title","Preencha todos campos obrigatorios");
                btn.removeClass('btn-primary');
                btnSalvar.removeClass('btn-primary');
                btnSalvar.addClass('btn-danger');
                btn.addClass('btn-danger');
                boolNovoServico = false;
            }

        }

        $("#dataos").datetimepicker({
            //timepicker: true,
            format: 'd/m/Y H:i',
            mask: true
        });
        $("#previsao").datetimepicker({
            //timepicker: true,
            format: 'd/m/Y H:i',
            mask: true
        });



        function preencherTabelaServicos() {
            $('.tabela').fadeOut();
            var cdOs = $('#cdos').val();

            $('.tbody').find('tr').remove();
            //  console.log("Preencher tabela codigo da Os: "+cdOs);
            $.ajax({
                url   : 'funcao/servico.php',
                type  : 'post',
                dataType : 'json',
                data : {
                    cdOs : cdOs,
                    acao : 'L'
                },
                success : function (data) {
                    //  console.log(data);
                    $.each( data.itens, function (i, j) {
                        var descricao = j.descricao;
                        if( descricao != "" ){
                            descricao = descricao.replace("#HIDE#","");
                        }else{
                            descricao = "";
                        }
                        //     console.log("Codigo do item: "+j.codigo);
                        var linha = "<tr>"
                            +"  <td>" + j.servico + "</td>"
                            +"  <td>" + j.funcionario + "</td>"
                            +"  <td>" + descricao + "</td>"
                            +"  <td>" + j.inicio + "</td>"
                            +"  <td>" + j.final + "</td>"
                            +"  <td>" + j.tempo + "</td>"
                            +"  <td> <a href='#editar' class='btn btn-lg '  title='Clique para alterar servico' onclick='abrirTelaAlterarServico("+ j.codigo +")'><i class='fa fa-pencil-square-o'></i></a>"
                            +        "<a href='#editar' class='btn btn-lg '  title='Clique para alterar servico' onclick='modalRemoverServico("+ j.codigo +",\""+ j.descricao +"\")'><i class='fa fa-times'></i></a>"
                            +  "</td>"
                            +"</tr> ";
                        $('.tbody').append( linha );
                    } );
                    $('.tabela').fadeIn();
                }

            });
        }



    </script>
@stop
