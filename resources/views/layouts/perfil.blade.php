@extends('layouts.app')

@section('content')

<link href="{{asset('/bootstrap-fileinput-master/css/fileinput.css')}}" media="all" rel="stylesheet" type="text/css"/>
<link href="{{asset('/bootstrap-fileinput-master/themes/explorer-fa/theme.css')}}" media="all" rel="stylesheet" type="text/css"/>
<script src="{{asset('/bootstrap-fileinput-master/js/fileinput.js')}}" type="text/javascript"></script>
<script src="{{asset('/bootstrap-fileinput-master/themes/explorer-fa/theme.js')}}" type="text/javascript"></script>
<script src="{{asset('/bootstrap-fileinput-master/themes/fa/theme.js')}}" type="text/javascript"></script>
<script type="text/javascript" src="{{asset('/bootstrap-3.2.0/js/bootstrap.js')}}"></script>
<link rel="stylesheet" href="{{asset('/bootstrap-3.2.0/css/bootstrap.css')}}">
<link rel="stylesheet" href="{{asset('/css/home_panel.css')}}">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<?php 
    setlocale (LC_ALL, 'pt_BR');
    date_default_timezone_set('America/Sao_Paulo');
?>
<div class="container">
    <div class="row">
        <form class="search-div">
          <div class="form-group col-md-12">
            <div class="input-group ">
              <input type="text" class="form-control col-md-4 new-elo" id="" placeholder="Buscar novos elos">
              <div class="input-group-addon"><span class="glyphicon glyphicon-search"></div>
            </div>
          </div>
        </form>
    </div>
    <div class="box-search input-group">
        <ul class="box-select">
                
        </ul>
    </div>
    <div class="row">
        <div class="col-md-8 col-md-offset-2 ">
            <div class="panel panel-default panel-menu">
                <div class="panel-heading">Feed de memórias </div>
                <form class="form-post" action="{{asset('savememoir')}}" method="post" accept-charset="utf-8" enctype="multipart/form-data">  
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
                    <div class="col-md-12 panel form-group">
                        <div class="col-md-8 ">
                            <input required maxlength="60" placeholder="Título da memória" class="post-textarea col-md-4 form-control" id="titlememoir" name="titlememoir">
                            <textarea required maxlength="200" class="post-textarea col-md-4 form-control" id="textmemoir" name="textmemoir"></textarea>
                            <span class="caracteres">200</span> <span class="catacterestxt">Restantes</span>
                            <div class="post-btn">
                                <button type="submit" class="post-btn btn btn-sm btn-success">Memória</button>
                            </div>
                        </div>                    
                    </div>
                    <div class="file-loading ">
                        <input id="file-0a" class="file " type="file" name="mediafile" > 
                    </div>
                    <!-- bootstrap-fileinput-master\js\fileinput.js  pluguin editado!-->
                </form>
                <hr>
                <div class="panel-body panel-feed-msg" data-spy="scroll">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif
                    @foreach($memoirfeedmsg as $msg)
                        <div class="alert col-md-12 msgs" >
                            <strong class="col-md-12 body-msg">{{$msg->titlememoir}}</strong>
                            <hr class="hr">
                            <div class="body-msg col-md-12">
                                {{$msg->textmemoir}}
                            </div>
                            @if ($msg->urlimg!=='')
                                <div id="card" class="container gallery col-md-6 zoom">
                                    <a linkimg="{{url('/') . $msg->urlimg}}" data-toggle="modal" data-target="#imgModal" class="aimg">
                                        <img src="{{url('/') . $msg->urlimg}}" class="img-responsive imagememoir">
                                    </a>
                                </div>
                            @endif   
                            <hr class="col-md-11">                         
                            <div class="time-post">
                                <strong class="col-md-12 body-dt-msg"><SPAN class="glyphicon glyphicon-time"></SPAN>{{$msg->updated_at }}</strong>
                            </div>
                            <div class="div-elos-post ">
                                <a class="elos-post" href="#"  ><span class="elos-count"></span><br><img class="elos-post" src="{{url('/') . '/images/elos.png'}}"></a>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
         </div>
    </div>    
    <div class="modal fade" id="imgModal" tabindex="-1" role="dialog" aria-labelledby="imgModal" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-body">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            <div>
              <img id="imgshow" width="100%" height="100%" src=""></image>
            </div>
          </div>
        </div>
      </div>
    </div>
</div>
<script>
$(document).ready(function(){
    $('.new-elo').keypress(function(){
        $(".box-select").html("");
        if($(this).val().length >= 3 ){
            $(".box-search").addClass( "panel-box-frm" );
            $(".box-search").css("display","block");
            var value = $(this).val();
            $.ajax({
                url:"{{route('searchusers')}}",
                method:"GET",
                data:{value:value},
                success:function(result){
                    $(".box-select").html("");
                    if (result[0]['alias'].length > 2) {
                          $(".box-select").html("");
                          for (i = 0; i <= result.length; i++) {
                              $(".box-select").append("<li id-value='result[i]['id']' class='li-box'><img class='elos-avatar img-circle' src='{{url('/')}}" + result[i]['url_avatar'] +" '><a href='"+result[i]['alias']+" '  class='a-box' >"+result[i]['alias']+" </a><span class='span-box' >" + result[i]['name']+"</span></li>");
                          }
                    }else{
                      $(".box-select").html("");
                      $(".box-search").css("display","none");
                  }
                },
                error: function() {
                    $(".box-select").html("");
                    $(".box-search").css("display","none");
                }
            })
        }else{
          //$(".box-search").removeClass("panel-box-frm" )
        }
    });
});
</script>
<script>
        /*$(document).ready(function () {
            $("#test-upload").fileinput({
                    'theme': 'fa',
                    'showPreview': true,
                    'allowedFileExtensions': ['jpg', 'png', 'gif'],
                    'elErrorContainer': '#errorBlock'
            });
                
        });*/
        $(document).on("keydown", "#textmemoir", function () {
            var caracteresRestantes = 200;
            var caracteresDigitados = parseInt($(this).val().length);
            var caracteresRestantes = caracteresRestantes - caracteresDigitados;

            $(".caracteres").text(caracteresRestantes);
        });
</script>
<script type="text/javascript">
    $(document).on("click", function () {
        $(".box-select").html("");
        $(".box-search").css("display","none");
    });
</script>
<script type="text/javascript">
    $(document).ready(function() { 
        $('.aimg').click(function(event){
            event.preventDefault();
            $('.modal img').attr('src', $(this).attr('linkimg'));
        });
    });
</script>
@endsection
