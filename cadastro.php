<head>
	<meta http-equiv='Content-Type' content='text/html;charset=UTF-8'>
	<link rel="stylesheet" href="css/paginas2.css" type="text/css" media="screen" />

	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>


        <script type="text/javascript" src="js/jquery-1.3.2.min.js"></script>

	<script type="text/javascript">
        function tamanho(){
		$("#main2", window.parent.document).height($("#tamanho").height() + 40);

		window.parent.parent.scrollTo(0,450)
	    }

        </script>

</head>

<?PHP include("inclu/config.php"); ?>

<body leftmargin= "0" topmargin="0" onload="tamanho();">
<div id="tamanho">
<center>

<BR><BR><font size=4><b>CADASTRAR CONTA</font></b> <BR><BR>

<?PHP
srand(time());
$random = (rand()%9999);

$random = substr(md5(time()), 0, 10);

?>
        <script type="text/javascript">

$(function (){
        $("#ps_loginname").blur(function(){//aqui a função é ativa qdo o usuário sair do campo email
                

                		if ( !$("#ps_loginname").val() ){
                        $("#mostrar").html('<img src=img/2.png title="Coloque um login!" alt"Senhas conferem!">');
}
else {

                var pega_email = $("#ps_loginname").val();
                $.post("inclu/verif_conta.php?server=<? echo $server;?>", {ps_loginname:pega_email}, function(pegar){
                        $("#mostrar").html(pegar);
                                
                });             
}

        });
});


$(function (){
        $("#ps_email").blur(function(){//aqui a função é ativa qdo o usuário sair do campo email
                
                var pega_email2 = $("#ps_email").val();
                $.post("inclu/verif_mail.php?server=<? echo $server;?>", {ps_email:pega_email2}, function(pegar){
                        $("#mostrar2").html(pegar);
                                
                });             
        });
});

$(function (){
        $("#ps_email2").blur(function(){//aqui a função é ativa qdo o usuário sair do campo email
                
		                		if ( $("#ps_email").val()) {
                		if ( $("#ps_email").val() == $("#ps_email2").val() ){
                        $("#mostrar3").html('<img src=img/ok.png title="E-mails conferem!" alt"E-mails conferem!">');
                }         
	else {
                        $("#mostrar3").html('<img src=img/2.png title="E-mail diferente do e-mail acima!" alt"E-mail diferente do e-mail acima!">');
	}  }
});
});

$(function (){
        $("#ps_repassword").blur(function(){//aqui a função é ativa qdo o usuário sair do campo email

               
 	              		if ( $("#ps_repassword").val() == $("#ps_password").val() ){
                        $("#mostrar5").html('<img src=img/ok.png title="Senhas conferem!" alt"Senhas conferem!">');
                        $("#mostrar6").html('<img src=img/ok.png title="Senhas conferem!" alt"Senhas conferem!">');
                }         
	else {
                        $("#mostrar5").html('<img src=img/2.png title="Senhas não correspondem!" alt"Senhas não correspondem!">');
                        $("#mostrar6").html('<img src=img/2.png title="Senhas não correspondem!" alt"Senhas não correspondem!">');
	}  
});
});

$(function (){
        $("#ps_name").blur(function(){//aqui a função é ativa qdo o usuário sair do campo email
                
                		if ( !$("#ps_name").val() ){
                        $("#mostrar4").html('<img src=img/2.png title="Coloque um nome!" alt"Senhas conferem!">');
                }         
	else {
                        $("#mostrar4").html('<img src=img/ok.png title="Nome correto!" alt"Senhas não correspondem!">');
	}  
});
});

$(function (){
        $("#extcode1").keyup(function(){//aqui a função é ativa qdo o usuário sair do campo email

               
                		if ( $("#extcode").val() == $("#extcode1").val() ){
                        $("#mostrar7").html('<img src=img/ok.png title="Códigos conferem!" alt"Códigos conferem!">');
                }         
	else {
                        $("#mostrar7").html('<img src=img/2.png title="Códigos diferente do código acima!" alt"Códigos diferente do código acima!">');
	}  
});
});

        </script>


 <div class="container" id="container1">

        <div class="row centered-form" style="width:500px;">

            <div class="">
                <div class="panel panel-default">
                    <div class="panel-body">

	<div class="alert alert-info bs-alert-old-docs">
      	  <strong>Bonus de cadastro:</strong> 15 dias VIP!
    	</div>

                        <form role="form" method=post name=regform action='cadastrar_done.php?codigo=<? echo $_GET[codigo];?>'>
                            <div class="form-group">
				<div class="input-group">
                                  <input type="text" name="ps_loginname" id="ps_loginname" class="form-control input-sm" placeholder="Login" maxLength=10>
                        	  <span class="input-group-addon"><div id="mostrar"> </div> </span>  
				</div> 
			    </div>

                            <div class="form-group">
				<div class="input-group">
                                <input type="text" name="ps_name" id="ps_name" class="form-control input-sm" placeholder="Seu Nome" maxLength=30>
                        	  <span class="input-group-addon"><div id="mostrar4"> </div> </span>  
				</div> 
                            </div>

                            <div class="form-group">
				<div class="input-group">
                                <input type="email" name="ps_email" id="ps_email" class="form-control input-sm" placeholder="E-mail" maxLength=40>
                        	  <span class="input-group-addon"><div id="mostrar2"> </div> </span>  
				</div> 
                            </div>

                            <div class="form-group">
				<div class="input-group">
                                <input type="email" name="ps_email2" id="ps_email2" class="form-control input-sm" placeholder="Confirmar E-mail" maxLength=40>
                        	  <span class="input-group-addon"><div id="mostrar3"> </div> </span>  
				</div> 
                            </div>

                            <div class="row">
                                <div class="col-xs-6 col-sm-6 col-md-6">
                                    <div class="form-group">
					<div class="input-group">
                                        <input type="password" name="ps_password" id="ps_password" class="form-control input-sm" placeholder="Senha" maxLength=10>
                        	        <span class="input-group-addon"><div id="mostrar5"> </div> </span>  
					</div> 
                                    </div>
                                </div>
                                <div class="col-xs-6 col-sm-6 col-md-6">
                                    <div class="form-group">
					<div class="input-group">
                                        <input type="password" name="ps_repassword" id="ps_repassword" class="form-control input-sm" placeholder="Confirmar Senha" maxLength=10>
					<span class="input-group-addon"><div id="mostrar6"> </div> </span>  
				</div> 
                                    </div>
                                </div>
                            </div>

	<input type="hidden" name="extcode" id="extcode" value="<?PHP print("$random"); ?>">

                            <div class="form-group">
				Clicando em continuar você aceita nossos <a href=cadastro_termos.php><b>Termos de uso</b></a>.
				</div>

                            <div class="row"> 
                                <div class="col-xs-6 col-sm-6 col-md-6">

                    	   		<div class="form-group">

						Código:<br>
                				<b><?PHP print("$random"); ?></b>
					</div>

                                </div>
                                <div class="col-xs-6 col-sm-6 col-md-6">
                    	   		<div class="form-group">

						<div class="input-group">
                                			<input type="text" name="extcode1" id="extcode1" class="form-control input-sm" placeholder="Digite o código" autocomplete="off" onpaste="return false;" >
                        	 			 <span class="input-group-addon"><div id="mostrar7"> </div> </span>  
					</div>
                                 </div>
                                 </div>



                            <input type="submit" value="Continuar" class="btn btn-info btn-block">
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

<style>

.container {
  	max-width: 700px;
}

.glyphicon {
	color: #000;
}

.centered-form {
    margin-top: 20px;
    margin-bottom: 20px;
}

.centered-form .panel {
    background: transparent;
    
}
.form-control {
	border: 0px solid #cccccc;
	border-radius: 0px;
	-webkit-box-shadow: inset 0 0px 0px rgba(0, 0, 0, 0);
	box-shadow: inset 0 0px 0px rgba(0, 0, 0, 0);
}

.input-group {

span {
	background-color: rgba(189, 195, 199, 1);
}
input {
	background-color: rgba(242, 242, 242, 1);
	border-top-right-radius:4px;
	border-bottom-right-radius:4px;
	font-weight:500;
}
  }


</style>


</div>
