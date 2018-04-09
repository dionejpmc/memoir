@extends('layouts.app')

@section('content')
<meta name="csrf-token" content="{{ csrf_token() }}">
<script type="text/javascript" src="{{asset('/bootstrap-3.2.0/js/bootstrap.js')}}"></script>
<script type="text/javascript" src="{{asset('/js/menu_panel.js')}}"></script>
<link rel="stylesheet" href="{{asset('/bootstrap-3.2.0/css/bootstrap.css')}}">
<link rel="stylesheet" href="{{asset('/css/menu_panel.css')}}">
<link href="{{asset('/bootstrap-fileinput-master/css/fileinput.css')}}" media="all" rel="stylesheet" type="text/css"/>
<link href="{{asset('/bootstrap-fileinput-master/themes/explorer-fa/theme.css')}}" media="all" rel="stylesheet" type="text/css"/>

<script src="{{asset('/bootstrap-fileinput-master/js/fileinput.js')}}" type="text/javascript"></script>

<script src="{{asset('/bootstrap-fileinput-master/themes/explorer-fa/theme.js')}}" type="text/javascript"></script>
<script src="{{asset('/bootstrap-fileinput-master/themes/fa/theme.js')}}" type="text/javascript"></script>
<link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Editar perfil</div>
                <form action="{{asset('home/menu/saveconfig')}}" method="post" accept-charset="utf-8" enctype="multipart/form-data">  
                    {{ csrf_field() }}
                    @if (session('erro'))
                        <div class="alert alert-danger alert-dismissable" id="warningMessage">
                             <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                            {{ session('erro') }}
                        </div>
                    @endif       
                    @if (session('success'))
                        <div class="alert alert-success alert-dismissable" id="successMessage">
                             <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                            {{ session('success') }}
                        </div>
                    @endif       
                    <script type="text/javascript">
                        $('#successMessage').delay(3000).fadeOut('slow');
                    </script>
                    <script type="text/javascript">
                        $('#warningMessage').delay(3000).fadeOut('slow');
                    </script>
                    <div id="avatarimg" class="alert alert-success">
                        <span>Imagem do avatar</span>
                        <div class="file-loading ">
                            <input id="file-0a" class="file " type="file" name="mediafileavatar" > 
                        </div>
                    </div>
                    <!-- bootstrap-fileinput-master\js\fileinput.js  pluguin editado!-->
                    <div id="capaimg" class="alert alert-success">
                        <span>Imagem da capa</span>
                        <div class="file-loading ">
                            <input id="file-0a" class="file " type="file" name="mediafilecapa" > 
                        </div>
                    </div>
                    <div class="div-textarea">
                        <div id="capaimg" class="alert alert-success">
                            <span>Sobre mim</span>
                            <textarea id="textarea" name="text"></textarea>
                        </div>
                    </div>
                    <div>
                        <button class="btn btn-primary btn-lg">Memorizar</button>
                    </div>
                </form>
        </div>
    </div>
</div>    
<script>
        $(document).ready(function () {
            $("#test-upload").fileinput({
                    'theme': 'fa',
                    'showPreview': true,
                    'allowedFileExtensions': ['jpg', 'png', 'gif'],
                    'elErrorContainer': '#errorBlock'
            });
        });
</script>
@endsection
