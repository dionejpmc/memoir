<!DOCTYPE html>
<html lang="en">
<head>
    <title>Memoir</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <meta name="google-signin-scope" content="profile email">
    <script type="text/javascript" src="{{asset('/bootstrap-3.2.0/js/bootstrap.js')}}"></script>
    <script type="text/javascript" src="{{asset('/js/jquery-3.2.1.min.js')}}"></script>


    <link rel="stylesheet" href="{{asset('/bootstrap-3.2.0/css/bootstrap.css')}}">


    <script src="https://apis.google.com/js/platform.js" async defer></script>
</head>
<body class="full">
<div class="container">
    <form class="form-horizontal" action="{{ route('register') }}" method="post"  id="contact_form">
      {{ csrf_field() }}
      <fieldset>
      <!-- Form Name -->
          <legend>Cadastre-se e divirta-se</legend>
          <!-- Text input-->
          <div class="form-group">
            <label class="col-md-4 control-label">Primeiro Nome</label>  
            <div class="col-md-4 inputGroupContainer">
            <div class="input-group">
            <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
            <input id="name"  name="name" placeholder="Primeiro Nome" class="form-control"  type="text">
             @if ($errors->has('name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
              @endif
              </div>
            </div>
          </div>
          <!-- Text input-->
          <div class="form-group">
            <label class="col-md-4 control-label" >Sobrenome</label> 
              <div class="col-md-4 inputGroupContainer">
              <div class="input-group">
            <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
            <input name="last_name" placeholder="Sobrenome" class="form-control"  type="text">
              </div>
            </div>
          </div>
          <!-- Text input-->
          <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
            <label class="col-md-4 control-label">E-Mail</label>  
              <div class="col-md-4 inputGroupContainer">
              <div class="input-group">
                  <span class="input-group-addon"><i class="glyphicon glyphicon-envelope"></i></span>
            <input  value="{{ old('email') }}" name="email" placeholder="E-Mail" class="form-control"  type="text">
           
              </div>
                @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
            </div>
          </div>
          <!-- Text input-->
          <div class="form-group">
            <label class="col-md-4 control-label">Telefone (Celular) #</label>  
              <div class="col-md-4 inputGroupContainer">
              <div class="input-group">
                  <span class="input-group-addon"><i class="glyphicon glyphicon-earphone"></i></span>
            <input name="phone" placeholder="(XX)X XXXX-XXXX" class="form-control" type="text">
              </div>
            </div>
          </div>
          <!-- Text input-->     
          <div class="form-group">
            <label class="col-md-4 control-label">Endereço (Rua, N°)</label>  
              <div class="col-md-4 inputGroupContainer">
              <div class="input-group">
                  <span class="input-group-addon"><i class="glyphicon glyphicon-home"></i></span>
            <input name="address" placeholder="Endereço" class="form-control" type="text">
              </div>
            </div>
          </div>
          <!-- Text input-->
          <div class="form-group">
            <label class="col-md-4 control-label">Cidade</label>  
              <div class="col-md-4 inputGroupContainer">
              <div class="input-group">
                  <span class="input-group-addon"><i class="glyphicon glyphicon-home"></i></span>
            <input name="city" placeholder="Cidade" class="form-control"  type="text">
              </div>
            </div>
          </div>
          <!-- Select Basic -->
          <div class="form-group"> 
            <label class="col-md-4 control-label">Pais</label>
              <div class="col-md-4 selectContainer">
              <div class="input-group">
                  <span class="input-group-addon"><i class="glyphicon glyphicon-list"></i></span>
              <select name="state" class="form-control selectpicker" >
                <option value=" ">Por favor, selecione sua localidade</option>
                <option>Brasil</option>
                <option>Portugal</option>
              </select>
            </div>
          </div>
          </div>
          <!-- Text input-->
          <div class="form-group">
            <label class="col-md-4 control-label">Zip Code</label>  
              <div class="col-md-4 inputGroupContainer">
              <div class="input-group">
                  <span class="input-group-addon"><i class="glyphicon glyphicon-home"></i></span>
            <input name="zip" placeholder="Zip Code" class="form-control"  type="text">
              </div>
          </div>
          </div>
          <!-- Text input-->
          <div class="form-group">
            <label class="col-md-4 control-label">Alias da rede social</label>  
             <div class="col-md-4 inputGroupContainer">
              <div class="input-group">
                  <span class="input-group-addon"><i class="glyphicon glyphicon-globe"></i></span>
            <input name="alias" placeholder="Alias para autenticação" class="form-control" type="text">
              </div>
            </div>
          </div>
          <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
            <label class="col-md-4 control-label">Senha</label>  
             <div class="col-md-4 inputGroupContainer">
              <div class="input-group">
                  <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
            <input id="password" name="password" placeholder="senha" class="form-control" type="text">
           
              </div>
                @if ($errors->has('password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
            </div>
          </div>


          <div class="form-group">
            <label class="col-md-4 control-label">Confirmar Senha</label>  
             <div class="col-md-4 inputGroupContainer">
              <div class="input-group">
                  <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
            <input id="password_confirm" name="password_confirmation" placeholder="senha" class="form-control" type="text">
           
              </div>
              
            </div>
          </div>
          <!-- radio checks -->
          		 <div class="form-group">
          		    <label class="col-md-4 control-label">Aceita os termos de contrato e serviço?</label>
          		    <div class="col-md-4">
          		        <div class="radio">
          		            <label>
          		                <input type="radio" name="terms" value="yes" /> Yes
          		            </label>
          		        </div>
          		        <div class="radio">
          		            <label>
          		                <input type="radio" name="terms" value="no" /> No
          		            </label>
          		        </div>
          		    </div>
          		 </div>
          <!-- Text area -->
          <div class="form-group">
            <label class="col-md-4 control-label"></label>
              <div class="col-md-4 inputGroupContainer">
              <div class="input-group">
                  <span class="input-group-addon"><i class="glyphicon glyphicon-pencil"></i></span>
                    <textarea class="form-control" name="reason" placeholder="Descreva o motivo pelo qual quer fazer parte do Memoir ou o que espera de nós."></textarea>
            </div>
            </div>
          </div>
          		<!-- Success message -->
          		<div class="alert alert-success" role="alert" id="success_message">Sucesso <i class="glyphicon glyphicon-thumbs-up"></i> Obrigado por nos contatar, em breve sua conta estará disponível para acesso, lembre de preencher corretamente todos os dados.
          		</div>
          		<!-- Button -->
          		<div class="form-group">
          		  <label class="col-md-4 control-label"></label>
          		  <div class="col-md-4">
          		    <button type="submit" class="btn btn-warning" >Enviar <span class="glyphicon glyphicon-send"></span></button>
          		  </div>
          		</div>
      		</fieldset>
		</form>
		</div>
	</div><!-- /.container -->

 </body>
</html>