@extends('layouts.app')

@section('content')
      
<script type="text/javascript" src="{{asset('/bootstrap-3.2.0/js/bootstrap.js')}}"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/bootbox.js/4.4.0/bootbox.min.js"></script>
<link rel="stylesheet" href="{{asset('/bootstrap-3.2.0/css/bootstrap.css')}}">
<link rel="stylesheet" href="{{asset('/css/personalperfil.css')}}">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.2/jquery-confirm.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.2/jquery-confirm.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.0/jquery-confirm.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.0/jquery-confirm.min.js"></script>

<?php 
foreach($userconfig as $value){ 
   $config = $value;
}
?>
<div class="container bg" >
    <div class="row">
        <div class="col-xs-4 col-md-4 col-sm-2 col1">
            <div class="image-avatar row">
                <img src="{{url('/') . $config->url_avatar}}" class="img-fluid img-circle avatar img-responsive" />
            </div>
            <span class="row">{{$user->alias}} <?php if (Auth::check()) { ?> <img class="new-elo example5" alt="Criar elo"  title="Criar elo " src="{{url('/') . '/images/elos.png'}}"><?php } ?></span>
            <span class="row">{{$user->name}}</span>
            <input class="input-elo"  type="hidden" name="value" value="{{$user->alias}}">
            <div class="status-info row">
               <a href=""> <p class="col-md-4">Elos</p> </a> 
               <a href=""> <p class="col-md-4">Memórias</p> </a>
               <a href=""> <p class="col-md-4">Informaçoes</p> </a>
            </div>
        </div>
        <div class="col-xs-8 col-md-8 col-sm-10 divimg">
            <img src="{{url('/') . $config->url_bg}}" class="bgimg img-fluid  img-responsive" />
        </div>
    </div><hr>
    <div  class="row texto">
        <p><span class="texto">{{$config->aboutme}} </span></p>
    </div>
</div>
<footer>

</footer>
<style type="text/css">

span img{
    width: 35px;
    height: 20px;
    margin-left: 5px;
    position: absolute; 
}
span img{

    animation: roll 3s infinite;
    transform: rotate(30deg);
}

@keyframes roll {
  0% {
    transform: rotate(0);
  }
  50% {
    transform: rotate(100deg);
    width: 20px;
    height: 15px;
  }
  100% {
    transform: rotate(360deg);
    width: 30px;
    height: 20px;
  }
}

</style>
<script>     
$(document).ready(function(){
    $('.new-elo').click(function(){
         bootbox.confirm({
            message: "Deseja alterar a relação com esse elo?",
            buttons: {
                confirm: {
                    label: 'Sim',
                    className: 'btn-success'
                },
                cancel: {
                    label: 'Não',
                    className: 'btn-success'
                }
            },
            callback: function (result) {
                if (result == true) {
                    var value = $('.input-elo').val();
                    $.ajax({
                        url:"{{route('newelo')}}",
                        method:"GET",
                        data:{value:value},
                        success:function(result){
                                       var dialog = bootbox.dialog({
                                            title: 'Estamos alterando seu elo com ' + value,
                                            message: '<p><i class="fa fa-spin fa-spinner"></i> Alterando...</p>'
                                        });
                                        dialog.init(function(){
                                            setTimeout(function(){
                                                dialog.find('.bootbox-body').html(result + ' com ' + value);
                                            }, 3000);
                                        }); 
                        },
                        error: function() {
                            bootbox.alert("Desculpe-nos! Ocorreu algum erro!");
                        }
                    })
                }
            }
        });
    });
});
</script>

@endsection
