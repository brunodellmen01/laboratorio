<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>LAB SYSTEM 2.0 | Log in</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.7 -->

  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <link rel="stylesheet" href="{{asset('tema_login/css/animate.css')}}">

  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{asset('tema_login/css/font-awesome.css')}}">
  <!-- Ionicons -->
  <link rel="stylesheet" href="{{asset('tema_login/css/ionicons.min.css')}}">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{asset('tema_login/css/AdminLTE.min.css')}}">

  <link rel="stylesheet" href="{{asset('css/style.css')}}">

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->

  <!-- Google Font -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>
<body class="hold-transition login-page">
<div class="login-box">
  <div class="login-logo">
    <!--<img src="img/logo.png"> -->
  </div>
  <!-- /.login-logo -->
  <div class="login-box-body">
    <p class="login-box-msg"><img src="{{asset('img/logo.png')}}"></p>

    <form method="POST" action="{{ route('login') }}">

		      <div class="form-group has-feedback">
		      	<input type="hidden" name="_token" value="{{ csrf_token() }}">

		        <input type="email" class="form-control" placeholder="INFORME SEU E-MAIL" value="{{ old('email') }}" required autofocus name="email" id="email">
		        <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
		      </div>

		      <div class="form-group has-feedback">
		        <input type="password" class="form-control" placeholder="INFORME SUA SENHA" name="password" required>
		        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
		      </div>

		      <div class="row">
		        <div class="col-xs-8">
		        </div>
		        <!-- /.col -->
		        <div class="col-xs-4">




		        </div>
		        <div class="col-md-12 text-center">
		        	@if ($errors->has('email'))

  							<span class="alert alert-danger help-block">
                    	    	<strong>{{ $errors->first('email') }}</strong>
                        	</span>


                    @endif

                    @if ($errors->has('password'))
                         <span class="help-block">
                            <strong>{{ $errors->first('password') }}</strong>
                        </span>
                    @endif
                    <button type="submit" class="btn btn-outline btn-primary btn-block btn-flat">LOGAR</button>


                    <a href="#demo" data-toggle="collapse" class="btn btn-outline btn-primary btn-block btn-flat">SUPORTE</a>

                    <div id="demo" class="collapse">
                      <br>
                      Luiz Henrique - (44) 9 9432 - 4300 <br>
                      Bruno Dellmen - (51) 9 8431 - 1224
                    </div>


		        </div>
		        <!-- /.col -->
		      </div>
    </form>
  </div>
  <!-- /.login-box-body -->
</div>
<!-- /.login-box -->


<!-- Modal -->
<div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Suporte</h4>
      </div>
      <div class="modal-body">
        <p>Some text in the modal.</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>

</body>
</html>
