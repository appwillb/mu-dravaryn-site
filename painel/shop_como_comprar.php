<head>
  <link type="text/css" rel="stylesheet" href="css/paginas.css">

        <script type="text/javascript" src="../js/jquery-1.3.2.min.js"></script>

	<script type="text/javascript">
		$("#main2", window.parent.document).height(800);
        function tamanho(){
		$("#main2", window.parent.document).height($("#tamanho").height() + 40);
	    }
        </script>
</head>
<body leftmargin='0' topmargin='0' onload="tamanho()">

<center>
<div id="tamanho">

<?
require("inclu/config.php");
require("inclu/cookie.php");
?>

<center><bR><BR><font size=3><b> COMO OBTER CRÉDITOS <bR><BR>

<table width=800 cellspacing=0>

  <thead>
	<tr>	
		<th colspan=2>Como contribuir e ganhar créditos</th>
	</tr>
  </thead>
<tr><td style='text-align:left;'><font size=2>
Para comprar no shopping é muito simples, você deve fazer o depósito em uma das contas abaixo ou fazer uma doação com o Pagseguro do UOL ou pelo Paypal.
  <p><b>Cada real depositado vale 1 crédito!</b>
  <bR><bR>Exemplo: 10 reais = 10 créditos!
</td></tr>

  <thead>
	<tr>	
		<th colspan=2>Como confirmar seu pagamento</th>
	</tr>
  </thead>
<tr><td style='text-align:left;'><font size=2>
- No menú do painel clique em Confirmar Pagamento.<bR>
- Coloque os dados do comprovante no formulário e envie.<BR>
- Em no máximo 2 dias úteis seu pagamento será confirmado.<bR>
</td></tr>

  <thead>
	<tr>	
		<th colspan=2>Após confirmar seu pagamento</th>
	</tr>
  </thead>
<tr><td style='text-align:left;'><font size=2>
- Os créditos serão adicionados na sua conta.<bR>
- Você poderá comprar os produtos que deseja com eles.
</td></tr></table>

<BR>
    <table width="800" border="0" align="center" cellpadding="0" cellspacing="0" bordercolor=black>
  <thead>
	<tr>	
		<th colspan=3>Contas para depósito</th>
	</tr>
	<tr>	
		<th colspan=3>Nas contas da Caixa Economina Federal o valor pode ser depositado nas lotéricas</th>
	</tr>
  </thead>

    <tr>

      <td valign=top><center>
       <img src="img/banco1.jpg" width="100" height="50"><br>
<b>Banco do Brasil</B><br>
<font size=2>
<br><b> Tipo de Conta: </b> <br> Conta Corrente
<br><b> Nome:         </b> <br> Luis Fernando M Ortiz
<br><b> Agencia:      </b> <br> 2923-8
<br><b> CONTA:        </b> <br> 19678-9
      </td>

   <td valign=top><center>
          <img src="img/caixa.jpg" width="140" height="50"><br>
<b>Caixa Econômica</B><br>
<font size=2>
<br><b> Tipo de Conta: </b> <br> 013 - Poupan&ccedil;a

<br><b> Nome:          </b> <br> Luis Fernando M Ortiz
<br><b> Agencia:       </b> <br> 0367
<br><b> CONTA:         </b> <br> 1632-0
       
      </td>
      <td valign=top><center>
          <img src="img/caixa.jpg" width="140" height="50"><br>

<b>Caixa Econômica</B><br>
<font size=2>
<br><b> Tipo de Conta:</b> <br> 013 - Poupan&ccedil;a
<br><b> Nome:         </b> <br> Luis Fernando M Ortiz
<br><b> Agencia:      </b> <br> 0367
<br><b> CONTA:        </b> <br> 73591-2
      </td>

    </tr>

  </table><Br>



<table width=800 cellspacing="0">
  <thead>
	<tr>	
		<th colspan=2>PAGSEGURO ou PAYPAL (Boleto, Cartão de Crédito, Débito)</th>
	</tr>
  </thead>
<tr style="background:transparent;"> <td><center>
<img src=img/banner_pagseguro.png>

<script>
    function checkDecimal(obj, objStr){
        var objNumber;
        if(isNaN(objStr) && objStr!=''){
            alert('Somente números por favor!');
            objNumber = '0.00';
        }
        else if(objStr==''){
            objNumber = '0.00';
        }
        else if(objStr.indexOf('.')!=-1){
            if(((objStr.length) - (objStr.indexOf('.')))>3){
                objStr = objStr.substr(0,((objStr.indexOf('.'))+3));
            }
            if(objStr.indexOf('.')==0){
                objStr = '0' + objStr;
            }
            var sLen = objStr.length;
            var TChar = objStr.substr(sLen-3,3);
            if(TChar.indexOf('.')==0){
                objNumber = objStr;
            }
            else if(TChar.indexOf('.')==1){
                objNumber = objStr + '0';
            }
            else if(TChar.indexOf('.')==2){
                objNumber = objStr + '00';
            }
        }
        else{
            objNumber = objStr + '.00';
        }
        obj.value = objNumber;
    }
</script>



<form target="PagSeguro" action="https://pagseguro.uol.com.br/security/webpagamentos/webpagto.aspx" method="post" name="TestePS" id="TestePS" />

<input type="hidden" name="email_cobranca" value="louisteam@hotmail.com">
<input type="hidden" name="tipo" value="CP" />
<input type="hidden" name="moeda" value="BRL" />
<input type="hidden" name="ref_transacao" value="Numero Randomico: <?php echo rand(1,999999); ?>" />


<input type="hidden" name="item_id_1" value="1" />
<input type="hidden" name="item_descr_1" value="Creditos MU Dravaryn.com.br" />
<input type="hidden" name="item_quant_1" value="1" /><br>
<font size=4>R$ <input type="text" name="item_valor_1" id="item_valor_1" value="50,00"  style = "font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 17px; border: 1px solid white; background-color : green; width:100; color:white;"
onblur="checkDecimal(this,this.value);" onfocus="if(this.value == '50,00') {this.value = '';}" />
</font>
<input type="hidden" name="item_frete_1" value="0" />


<input type="hidden" name="cliente_email" value="<?php echo $mail; ?>" /><br><bR>

<input type="submit" name="ok" value="Gerar Pagamento" style = "font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 17px; border: 1px solid white; background-color : green; color:white;"/><br><br>

</form>
</td> <td>

<center> <b>Pagamento em dólares:<br>

<form action="https://www.paypal.com/cgi-bin/webscr" method="post" target="_blank">
<input type="hidden" name="cmd" value="_s-xclick">
<input type="hidden" name="hosted_button_id" value="EJR9URFDUUFPG">
<input type="image" src="img/aceitacao_parcelamento_vertical_12x.png" border="0" name="submit" alt="PayPal - A maneira fácil e segura de enviar pagamentos online!" style='border:0;'>
<img alt="" border="0" src="https://www.paypalobjects.com/pt_BR/i/scr/pixel.gif" width="1" height="1">
</form>

<br><center> <b>Pagamento em reais:<br>

<form action="https://www.paypal.com/cgi-bin/webscr" method="post" target="_blank">
<input type="hidden" name="cmd" value="_s-xclick">
<input type="hidden" name="hosted_button_id" value="QZ5AG4APJQVSA">
<input type="image" src="img/aceitacao_parcelamento_vertical_12x.png" border="0" name="submit" alt="PayPal - A maneira fácil e segura de enviar pagamentos online!" style='border:0;'>
<img alt="" border="0" src="https://www.paypalobjects.com/pt_BR/i/scr/pixel.gif" width="1" height="1">
</form>

</td></tr></table>


     </td>
    </tr>

  </table><br>


<table width=800 cellspacing=0>

  <thead>
	<tr>	
		<th colspan=2>Bonus ao depositar</th>
	</tr>

    	<tr>
      		<th>Valor do depósito:      </th>
      		<th>Você Ganha o bonus de:      </th>
    	</tr>
  </thead>

    <tr>
      <td>R$ 20,00 ou +</td>
      <td>+ 10 Créditos
      </td>
    </tr>
    <tr>
      <td>R$ 30,00 ou +</td>
      <td>+ 15 Créditos
      </td>
    </tr>
    <tr>
      <td>R$ 40,00 ou +</td>
      <td>+ 20 Créditos
      </td>
    </tr>
    <tr>
      <td>R$ 50,00 ou +</td>
      <td>+ 25 Créditos
      </td>
    </tr>
    <tr>
      <td>R$ 100,00 ou +</td>
      <td>+ 50 Créditos
      </td>
    </tr>
    <tr>
      <td>R$ 150,00 ou +</td>
      <td>+ 150 Créditos
      </td>
    </tr>
    <tr>
      <td>R$ 200,00 ou +</td>
      <td>+250 Créditos
      </td>
    </tr>
    <tr>
      <td><center>R$ 300,00 ou +</td>
      <td>+900 Créditos
      </td>
    </tr>
  </table>
</td></tr></table>

<br>
<table width=800 cellspacing=0>
  <thead>
	<tr>	
		<th colspan=2>Bonus EXP ao depositar</th>
	</tr>

    	<tr>
      		<th>Valor do depósito:      </th>
      		<th>Bonus exp:      </th>
    	</tr>
  </thead>
    <tr>
      <td>R$ 20,00 ou +</td>
      <td>+ 100 exp
      </td>
    </tr>
    <tr>
      <td >R$ 30,00 ou +</td>
      <td>+ 150 exp
      </td>
    </tr>
    <tr>
      <td>R$ 40,00 ou +</td>
      <td>+ 200 exp
      </td>
    </tr>
    <tr>
      <td>R$ 50,00 ou +</td>
      <td>+ 250 exp
      </td>
    </tr>
    <tr>
      <td >R$ 100,00 ou +</td>
      <td>+ 500 exp
      </td>
    </tr>
    <tr>
      <td>R$ 150,00 ou +</td>
      <td>+ 800 exp
      </td>
    </tr>
    <tr>
      <td>R$ 200,00 ou +</td>
      <td>+1500 exp
      </td>
    </tr>
    <tr>
      <td>R$ 300,00 ou +</td>
      <td>+2500 exp
      </td>
    </tr>
  </table><br>


</div>


