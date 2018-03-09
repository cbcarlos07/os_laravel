@extends('principal')
@section('title','Recebimentos')
@section('content')
    <input type="hidden" id="usuario" value="{{ Session::get('login') }}">
    <input type="hidden" id="funcionario" value="{{ Session::get('funcionario') }}">

    <div class="page-content">
        <div class="row">

            <div class="col-md-8 " style="background: #ffffff">

                <h4>Recebimento de Chamados</h4>
                <hr />

                <table class="table table-hover table-responsive tabela" >
                    <thead class="thead">
                       <tr>
                           <th>#</th>
                           <th>Data</th>
                           <th>Descri&ccedil;&atilde;o</th>
                           <th>Setor</th>
                           <th>Solicitante</th>
                           <th>Criado por</th>
                           <th></th>
                       </tr>
                    </thead >
                    <tbody class="tbody">
                    </tbody>
                </table>

            </div>

        </div>
    </div>
@stop

@section('js')
    <script>
        $(document).ready( function () {
            preencherTabela();
        } );

        function preencherTabela() {
            $.ajax({
                url      : '{{ route('os.recebimentos') }}',
                dataType : 'json',
                type     : 'get',
                success : function (data) {

                    $.each(data, function (i, j) {
                        var tbody = "<tr>" +
                            "<td>" + j.cd_os + "</td>"+
                            "<td>" + j.data + "</td>"+
                            "<td>" + j.ds_servico + "</td>"+
                            "<td>" + j.nm_setor + "</td>"+
                            "<td>" + j.nm_solicitante + "</td>"+
                            "<td>" + j.nm_usuario + "</td>"+
                            "<td> <a href='#rec' class='btn btn-primary btn-rec btn-xs' data-id='"+ j.cd_os +"'>Receber</a>  </td>"+
                            "</tr>";
                        $('.tbody').append( tbody );

                    });

                    $('.btn-rec').on('click', function () {
                        var id = $( this ).data( 'id' );
                        var form = $('<form action="{{ route('os.telaCadastro') }}" method="post">'
                            +'<input type="hidden" name="_token" value="{{ csrf_token() }}" />'
                            +'<input type="hidden" name="cdos" value="'+ id +'" />'
                            + '</form>');
                        $('body').append( form );
                        form.submit();
                    });

                }
            });
        }
    </script>
@stop