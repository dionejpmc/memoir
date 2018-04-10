@extends('layouts.app')
@section('content')
<script type="text/javascript" src="{{asset('/bootstrap-3.2.0/js/bootstrap.js')}}"></script>
<link rel="stylesheet" href="{{asset('/bootstrap-3.2.0/css/bootstrap.css')}}">
<link href="{{asset('/bootstrap-fileinput-master/css/fileinput.css')}}" media="all" rel="stylesheet" type="text/css"/>
<link href="{{asset('/bootstrap-fileinput-master/themes/explorer-fa/theme.css')}}" media="all" rel="stylesheet" type="text/css"/>
<script src="{{asset('/bootstrap-fileinput-master/js/fileinput.js')}}" type="text/javascript"></script>
<!--<script src="{{asset('/bootstrap-fileinput-master/themes/explorer-fa/theme.js')}}" type="text/javascript"></script>!-->
<!--<script src="{{asset('/bootstrap-fileinput-master/themes/fa/theme.js')}}" type="text/javascript"></script>!-->

<link rel="stylesheet" href="{{asset('/css/home_panel.css')}}">
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js" type="text/javascript"></script>
<meta http-equiv="expires" content="no-cache">
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
    <div id="style-1" class="elos-div table-overflow scrollbar " >
        <li  class="a-box title-box" ><a href="{{$var->alias}}" class="a-box title-box" href="#"> Seus Elos</a> </li>
        <div class="title-nav"> <a class="elos-post" ><img class="elos-post" src="{{url('/') . '/images/elos.png'}}"></a></div>
        <hr class="hr">
        <div class="force-overflow">
            <nav >
                <ul class="ul-elos">
                    @foreach($created_elos as $var)
                    <div class="div-box target"> <li class="a-box" ><a href="{{$var->alias}}" class="a-box a-href"><img src-img="{{$var->url_avatar}}" class="avatar-box img-circle" src="{{url('/') . $var->url_avatar}}"> {{$var->name}}</a></li></div>
                    @endforeach
                </ul>
            </nav>
        </div>
    </div>
    <div id="style-2" class="msg-div table-overflow scrollbar " >
        <li class="a-box-msg title-box-msg " ><a href="" class="a-box-msg title-box-msg" > Suas mensagens</a> </li>
        <hr class="hr">
        <div class="force-overflow">
            <nav >
                <ul class="ul-msg">
                </ul>
            </nav>
        </div>
    </div>
    <div class="row">
        <div class="col-md-8 col-md-offset-2 ">
            <div class="panel panel-default panel-menu">
                <div class="panel-heading">Feed de memórias </div>
                <form class="form-post" action="{{asset('savememoir')}}" method="post" accept-charset="utf-8" enctype="multipart/form-data">  
                    {{ csrf_field() }}
                    @if (session('erro'))
                        <div class="alert alert-danger alert-dismissable" id="warningMessage">
                             <a class="elos-post" href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                             {{ session('erro') }}
                        </div>
                    @endif       
                    @if (session('success'))
                        <div class="alert alert-success alert-dismissable" id="successMessage">
                             <a class="elos-post" href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
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
                                <a class="elos-post" href="#"><img src="{{url('/') . '/images/elos.png'}}"></a>
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
        $(".popup").fadeOut(1000);
        if($(this).val().length > 2 ){
            $(".box-search").addClass( "panel-box-frm" );
            $(".box-search").css("display","block");
            var value = $(this).val();
            $.ajax({
                url:"{{route('searchusers')}}",
                method:"GET",
                data:{value:value},
                success:function(result){
                    var i =0;
                    $(".box-select").html("");
                    if (result[i]['alias'].length > 2) {
                          console.log(result[i]['alias']);
                          $(".box-select").html("");
                          for (i = 0; i <= result.length -1 ; i++) {
                                if (result[i]['alias'].length -1 > 2) {
                                    console.log(result[i]['alias']);
                                    $(".box-select").append("<li id-value='"+result[i]['id']+"' class='li-box'><img class='elos-avatar img-circle' src='{{url('/')}}" + result[i]['url_avatar'] +" '><a href='"+result[i]['alias']+" '  class='a-box' >"+result[i]['alias']+" </a><span class='span-box' >" + result[i]['name']+"</span></li>");
                          
                                }else{
                                    console.log("Nenhum elo encontrado");
                                }
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
          $(".box-select").html("");
          return;
        }
    });
});
</script>
<script type="text/javascript">
$(document).on("click", ".spanmsg", function () {
        var idsender = $(this).attr("data-idsender"),
            idmsg    = $(this).attr("data-idmsg");
        $(this).fadeOut(2000);
       window.setTimeout(function(){
            $(this).remove();
            $.ajax({
                   type: "get",
                   data: {idmsg:idmsg, idsender:idsender}, // serializes the form's elements.
                   url: "{{route('profile.edit_message')}}",
                   success: function(data)
                   {     
                    
                   },
                    error: function() {
                       console.log('erro ao mudar status da menssagem');
                    }
            });
       },2000);
});
</script>
<script type="text/javascript">
$(document).ready(function () {
    $.get("{{route('profile.get_message')}}",function(data){
        console.log("mensagens disponiveis");
        console.log(data);
        for (i = 0; i <=  data.length -1 ; i++) {
            $(".ul-msg").append("<div class='spanmsg' data-idmsg='"+data[i]['id']+"' data-idsender='"+data[i]['idsender']+"'><span  class='close' style='right:8px; position:absolute; z-index:9000; '>&#x2718;</span>"+data[i]['message']+"</div>");
        }
    });
});
</script>
<script>
$(document).on("keydown", "#textmemoir", function () {
    var caracteresRestantes = 200;
    var caracteresDigitados = parseInt($(this).val().length);
    var caracteresRestantes = caracteresRestantes - caracteresDigitados;
    $(".caracteres").text(caracteresRestantes);
    $(".popup").fadeOut(1000);
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
<script type="text/javascript">
$(".target").mouseenter(function(event){
    event.stopPropagation();
    event.preventDefault();
    var self    = $(this),
        eq  = self.index(),
        nome   = self.text();
    var alias = $(".a-href:eq("+eq+")").attr("href");
    var avatar = $(".avatar-box:eq("+eq+")").attr("src");
    if (!$(".popup:eq("+eq+")").length) {
        $(".target:eq("+eq+")")
            .append("<div class='arrow_box popup btn btn-primary'"  
                +"style='-webkit-transform: translate3d(0px, 0px, 0px); width:600px; height:150px; position:fixed; margin-left: 18%;margin-top: -50px; z-index: 9999; opacity:0.9; border: solid 1px #ccc;'>" 
                +"<img src='"+avatar+"' class='img-circle' style='width:62px; border: solid 4px #fff;  margin-top:-35px;'>"
                +"<span aria-hidden='true' class='close' style='top:0; left:95%; position:absolute; width:30px;  border-radius:20px 20px 20px 20px ; '>&#x2718;</span>"
                +"<div  id='privatemsg'> <div class='form-group'>"
                +"<input id='msgvalue' alias='"+alias+"' name='"+alias+"' class='msgvalue form-control box_msg_ta' style='z-index: 1002; width:570px; height:50px; color:black;'></div>"
                +"<input class='aliasname' type='hidden' name='alias' value='"+alias+"'>"
                +"<button class='btnsubmit form-control btn btn-success btn-x'>Enviar</button>"
                +"</div>"
                +"</div>");
        $(".close:eq("+eq+")").on("click",function(){
            $(".popup:eq("+eq+")").fadeOut("slow");
        });     
        $(this).off('mouseleave mouseenter');  
        $(".btnsubmit:eq("+eq+")").on("click",function() {
            var inputmsg = $(".msgvalue:eq("+eq+")").val(); // the script where you handle the form input.
            var alias =    $(".aliasname:eq("+eq+")").val();
            $.ajax({
                   type: "get",
                   url: "{{route('profile.private_message')}}",
                   data: {input1: inputmsg, input2:alias}, // serializes the form's elements.
                   success: function(data)
                   {
                       console.log(data);
                       $(".popup").fadeOut("slow");
                   },
                    error: function() {
                       console.log('erro');
                       $(".popup").fadeOut("slow");
                    }
            });
        });
    }
    else{
        $(".popup:eq("+eq+")").fadeIn("slow");
    } 
});
</script>
@endsection