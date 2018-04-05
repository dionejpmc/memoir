<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
  <head>
      <meta charset="utf-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <title>Index</title>
      <script type="text/javascript" src="{{asset('/bootstrap-3.2.0/js/bootstrap.js')}}"></script>
      <script type="text/javascript" src="{{asset('/js/jquery-3.2.1.min.js')}}"></script>
      <link rel="stylesheet" href="{{asset('/css/index_style.css')}}">
      <link rel="stylesheet" href="{{asset('/css/form.css')}}">
      <link rel="stylesheet" href="{{asset('/bootstrap-3.2.0/css/bootstrap.css')}}">
  </head>
<body class="full">
  @section('content')
	<div class="container-fluid" > <!--Wraper!-->
    <nav class="navbar navbar-inverse">
      <div class="container-fluid">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>                        
          </button>
          <a class="navbar-brand" href="#">Memoir</a>
        </div>
        <div class="collapse navbar-collapse" id="myNavbar">
          <ul class="nav navbar-nav navbar-right">
            <li><a href="<?php echo url('/register'); ?>"><span class="glyphicon glyphicon-user"></span> Sing Up</a></li>
            <li><a href="{{ route('login') }}"><span class="glyphicon glyphicon-log-in"></span> Login</a></li>
            <li><a href=""><span class="glyphicon glyphicon-eye-open"></span> Ajuda</a></li>
          </ul>
        </div>
      </div>
    </nav>
  </div><!-- END Wraper !-->
  <div class="div-footer">
        <p class="p">Doar</p>
        <div class="row">
            <img class="img" src="{{url('/') . '/images/bitcoin.png'}}">
            <span class="span">1EzwPxkc2RzgtogCvRMY95HXXNEAJPsVwY</span>
        </div>
        <div class="row">
            <img class="img" src="{{url('/') . '/images/iota.png'}}">
            <span class="span">KGMLQRJMWNDSLRKFASNDFASJDAARPQIESCDKGXAX9BRKQUNKB9MUOGMRSNUFUNDUNQRFKBWAKLRQPDXL9</span>
        </div>
  </div>
</body>
</html>