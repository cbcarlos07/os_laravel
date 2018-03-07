<!DOCTYPE html>
<html lang="pt">
<head>

    @include('include.head')

    @yield('css')

</head>
<body>
@include('include.cabecalho')
<div class="page-content">
    <div class="row">
        @include('include.menu')
        @yield('content')
    </div>

</div>
@include('include.footer')

<script src="{{ URL('js/jquery.js') }}"></script>
<script src="{{ URL('js/bootstrap.min.js') }}"></script>

<script src="{{ URL('js/chosen.jquery.js') }}"></script>
<script >
    $(document).ready(function () {

        var selector = '.nav li';
        var url = window.location.href;
        var target = url.split('/');

        $(selector).each(function(){
            var urlAtual = target[target.length-1].split('#');
            // console.log(  $(this).find('a').attr('href')+" - "+ urlAtual[0]);
            // console.log(  $(this).find('a').attr('href')+" - "+ url  );
            // if( $(this).find('a').attr('href') ===urlAtual[0]){
            if( $(this).find('a').attr('href') ===url){
                //if($(this).find('a').attr('href')===($(this).find('a').attr('href'))){

                $(selector).removeClass('current');
                $(this).addClass('current');
            }
        });
    });


    function loadTotalMenu( usuario, funcion ) {
        //verificaPermissao( usuario );
        setTimeout(function () {
            carregarTotalRecebimentos();
            carregarTotalMeusChamados( usuario );
            carregarTotalMeusServicos( funcion );
            atualizarSaudacao();

        }, 100);





    }

    function atualizarSaudacao() {
        var data = new Date();
        var hora = data.getHours();

        var msg = "";
        if( hora > 0 && hora < 12 ){
            msg = "Bom dia, ";
        }else
        if( hora >= 12 ){
            msg = "Boa tarde, ";
        }else if( hora > 18 ){
            msg = "Boa noite, ";
        }

        $('span.saudacao').text( msg );

    }


    function carregarTotalRecebimentos() {

        var total = $('span.total-recebimentos');

        total.text('');

        $.ajax({
            url  : 'funcao/os.php',
            type : 'post',
            dataType: 'json',
            data : {
                acao : 'P'
            },
            success : function (data) {
                var qtde = data.aguardando ;
                if( qtde > 0 ){
                    $('.rec').addClass( 'noti' );
                    total.text( qtde );
                }else{
                    $('.rec').removeClass( 'noti' );

                }

            }
        });

    }



    function carregarTotalMeusChamados( usuario ) {

        var total = $('span.total-chamados');

        //console.log("Usuario Menus: "+usuario);

        total.text('');

        $.ajax({
            url  : 'funcao/os.php',
            type : 'post',
            dataType: 'json',
            data : {
                acao : 'H',
                responsavel : usuario
            },
            success : function (data) {

                var qtde = data.meuschamados ;
                if( qtde > 0 ){
                    $('.my').addClass( 'noti' );
                    total.text( qtde );
                }else{
                    $('.my').removeClass( 'noti' );

                }
            }
        });

    }


    function carregarTotalMeusServicos( usuario ) {

        var total = $('span.total-servicos');

        total.text('');

        $.ajax({
            url: 'funcao/os.php',
            type: 'post',
            dataType: 'json',
            data: {
                acao: 'G',
                responsavel: usuario
            },
            success: function (data) {
                // total.text(data);
                var qtde = data.meuservicos ;
                if( qtde > 0 ){
                    $('.serv').addClass( 'noti' );
                    total.text( qtde );
                }else{
                    $('.serv').removeClass( 'noti' );

                }

            }
        });
    }

</script>
@yield('js')

</body>
</html>