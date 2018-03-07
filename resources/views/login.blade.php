<!DOCTYPE html>
<html>
<head>
    <title>Ordem de Servi&ccedil;o</title>
    <link rel="short icon" href="{{ URL('images/ham.png') }}" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Bootstrap -->
    <link href="{{ URL('css/bootstrap.min.css') }}" rel="stylesheet">
    <!-- styles -->
    <link href="{{ URl('css/styles.css') }}" rel="stylesheet">
    <link href="{{ URL('css/load.css') }}" rel="stylesheet" type="text/css" />

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="{{ URL('js/html5shiv.js') }}" type="javascript"></script>
    <script src="{{ URL('js/respond.min.js') }}"></script>
    <![endif]-->
</head>
<body class="login-bg">
<div class="linear-progress-material loading">
    <div class="bar bar1"></div>
    <div class="bar bar2"></div>
</div>
<div class="alerta"
     style="text-align: center; position: absolute; width: 100%"
></div>

<div class="header">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <!-- Logo -->
                <div class="logo">
                    <h1><a href="#">Ordem de Servi&ccedil;o v2.5.8</a></h1>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="page-content container">
    <div class="row">
        <div class="col-md-4 col-md-offset-4">
            <div class="login-wrapper">
                <div class="box">
                    <div class="content-wrap">
                        <h5>Acesse com seu usu&aacute;rio e senha</h5>
                        <form action="{{ route('logar') }}" method="post" >
                            <input type="hidden" name="_token" value="{{ csrf_token() }}" }}>
                            <div class="login form-group has-feedback {{ $errors->has('login') ? ' has-error' : '' }}">
                                <input class="form-control" id="usuario" name="login" placeholder="Usu&aacute;rio" value="{{ old('login') }}" style="text-transform: uppercase" required>
                                <span class="error-login"></span>
                                @if ($errors->has('login'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('login') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="form-group has-feedback {{ $errors->has('senha') ? ' has-error' : '' }}">
                                <input class="form-control" id="p" name="senha" type="password" placeholder="Senha" >
                                @if ($errors->has('senha'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('senha') }}</strong>
                                    </span>
                                @endif
                            </div>

                            <input class="form-control" id="empresa" type="text" placeholder="Empresa">
                            <div class="action">
                                <button type="submit" class="btn btn-primary signup" >Login</button>
                            </div>
                        </form>
                    </div>
                </div>

                <div class="already">

                </div>
            </div>
        </div>
    </div>
</div>



<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<!--<script src="https://code.jquery.com/jquery.js"></script>-->
<script src="{{ URL('js/jquery.js') }}"></script>
<!-- Include all compiled plugins (below), or include individual files as needed -->
<script src="{{ URL('js/bootstrap.min.js') }}"></script>
<script src="{{ URL('js/custom.js') }}"></script>
<script>


    $(document).ready(function () {
        $('.loading').fadeOut();
        $('.alerta').fadeOut();
    });

    $('#usuario').on('keyup', function () {
        $('.login').removeClass( 'has-error' );
        $('#empresa').val( '' );
        $('.error-login').removeClass('help-block').html('');
    });

    $('#usuario').on('focusout', function () {
        var usuario = $(this).val();
        $.ajax({
            url : '{{ route('empresa') }}',
            type: 'post',
            dataType : 'json',
            data : {
                _token  : '{{ csrf_token() }}',
                usuario : usuario
            },
            success : function (data) {
                // console.log( data[0][0].ds_multi_empresa );
                console.log( data[0].length );
                if( data[0].length > 0 ){
                    $('#empresa').val( data[0][0].ds_multi_empresa );
                    $('.login').removeClass( 'has-error' );
                    $('.error-login').removeClass('help-block').html('')
                }else{
                    $('#empresa').val( '' );
                    $('.login').addClass( 'has-error' );
                    $('.error-login').addClass('help-block').html(' <strong>Login não encontrado</strong>')
                }

            }
        });
    });
</script>

</body>
</html>