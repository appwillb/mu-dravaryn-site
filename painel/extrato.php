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
<body style="background-color: transparent" leftmargin='0' topmargin='0' onload="tamanho()">

<center>
<div id="tamanho">

<center><bR><BR><font size=3><b> EXTRATO <bR><BR>

<?
require("inclu/config.php");
require("inclu/cookie.php");
?>

<table border='0' cellspacing='0' cellpadding='0' width="660">

<?

$sql_check = mssql_query("(SELECT valor as valor, tabela=1, tipo as tipo, data as data, id_creditos as idd from log_creditos where login='$login')
UNION (SELECT dias as valor, tabela=2, tipo as tipo, data as data, id_vip as idd from log_vip where login='$login') order by data asc, idd asc");
$quant = mssql_num_rows($sql_check);

for($i=0;$i < $quant;++$i)
{
$username_get = mssql_fetch_row( $sql_check );
$valor = $username_get[0];
$tabela= $username_get[1];
$tipo  = $username_get[2];
$data  = $username_get[3];

if ($i % 2==0){
$color= "$fundo_tab_cor";
} else {
$color= "#cccccc"; }

$data = date_create("$data");
$data = date_format($data, 'd-m-Y H:i');


if ($tabela==1){

if ($valor < 0){
$add= "Removidos";
$color2= "$font_color1";
$img = "<img src=img/Minus_Icon.png height=15>";
}
else {
$add= "Adicionados";
$color2= "$font_color2";
$img = "<img src=img/add.gif height=15>";
}

if ($tipo==1){
echo "<tr bgcolor=$color height=23>
	<td width=10><B> </td>
	<td width=120><B>$data </td>
	<td style='text-align:left;'>$img <font color=$color2>$add <b>$valor</b> créditos em sua conta.</font>
	</td>
      </tr>";
}

if ($tipo==2){
echo "<tr bgcolor=$color height=23>
	<td width=10><B> </td>
	<td width=120><B>$data </td>
	<td style='text-align:left;' >$img <font color=$color2>$add <b>$valor</b> créditos pela venda de uma conta no shopping.</font>
	</td>
      </tr>";
}

if ($tipo==3){
echo "<tr bgcolor=$color height=23>
	<td width=10><B> </td>
	<td width=120><B>$data </td>
	<td style='text-align:left;' >$img <font color=$color2>$add <b>$valor</b> créditos em sua conta.</font>
	</td>
      </tr>";
}

if ($tipo==4){
echo "<tr bgcolor=$color height=23>
	<td width=10><B> </td>
	<td width=120><B>$data </td>
	<td style='text-align:left;' >$img <font color=$color2>$add <b>$valor</b> créditos da sua conta para compra de um item no Shopping.</font>
	</td>
      </tr>";
}

if ($tipo==5){
echo "<tr bgcolor=$color height=23>
	<td width=10><B> </td>
	<td width=120><B>$data </td>
	<td style='text-align:left;' >$img <font color=$color2>$add <b>$valor</b> créditos da sua conta para compra de VIP no Shopping.</font>
	</td>
      </tr>";
}

if ($tipo==6){
echo "<tr bgcolor=$color height=23>
	<td width=10><B> </td>
	<td width=120><B>$data </td>
	<td style='text-align:left;' ><img src=../img/ouro15.png height=15> <font color=$color2> Você ganhou <b>$valor</b> créditos.</font>
	</td>
      </tr>";
}

if ($tipo==7){
echo "<tr bgcolor=$color height=23>
	<td width=10><B> </td>
	<td width=120><B>$data </td>
	<td style='text-align:left;' ><img src=../img/ouro15.png height=15> <font color=$color2> Você ganhou <b>$valor</b> crédito por fazer 100 resets com um personagem.</font>
	</td>
      </tr>";
}

if ($tipo==8){
echo "<tr bgcolor=$color height=23>
	<td width=10><B> </td>
	<td width=120><B>$data </td>
	<td style='text-align:left;' ><img src=img/Minus_Icon.png height=15> <font color=$color2> Foram retirados <b>$valor</b> créditos da sua conta para comprar uma conta do Shopping.</font>
	</td>
      </tr>";
}

if ($tipo==9){
echo "<tr bgcolor=$color height=23>
	<td width=10><B> </td>
	<td width=120><B>$data </td>
	<td style='text-align:left;' ><img src=img/add.gif height=15> <font color=$color2> Foi adicionado <b>$valor</b> crédito na sua conta por trocar Golds x Créditos.</font>
	</td>
      </tr>";
}

if ($tipo==10){
echo "<tr bgcolor=$color height=23>
	<td width=10><B> </td>
	<td width=120><B>$data </td>
	<td style='text-align:left;' ><img src=img/add.gif height=15> <font color=$color2> Foram adicionados <b>$valor</b> créditos na sua conta pelo evento REI DO MK.</font>
	</td>
      </tr>";
}

if ($tipo==11){
echo "<tr bgcolor=$color height=23>
	<td width=10><B> </td>
	<td width=120><B>$data </td>
	<td style='text-align:left;' ><img src=../img/ouro15.png height=15> <font color=$color2> Você ganhou <b>$valor</b> créditos por ganhar um sorteio para usuários online.</font>
	</td>
      </tr>";
}

if ($tipo==12){
echo "<tr bgcolor=$color height=23>
	<td width=10><B> </td>
	<td width=120><B>$data </td>
	<td style='text-align:left;' ><img src=../img/ouro15.png height=15> <font color=$color2> Você ganhou <b>$valor</b> crédito por ficar 12 horas online.</font>
	</td>
      </tr>";
}

if ($tipo==13){
echo "<tr bgcolor=$color height=23>
	<td width=10><B> </td>
	<td width=120><B>$data </td>
	<td style='text-align:left;' ><img src=img/add.gif height=15> <font color=$color2> Você ganhou <b>$valor</b> créditos por um depósito realizado por uma divulgação.</font>
	</td>
      </tr>";
}

if ($tipo==14){
echo "<tr bgcolor=$color height=23>
	<td width=5><B> </td>
	<td width=105><B>$data </td>
	<td style='text-align:left;' ><img src=img/Minus_Icon.png height=15> <font color=$color2> Foram retirados <b>$valor</b> créditos para comprar um báu extra no Shopping.</font>
	</td>
      </tr>";
}

if ($tipo==15){
echo "<tr bgcolor=$color height=23>
	<td width=10><B> </td>
	<td width=120><B>$data </td>
	<td style='text-align:left;' ><img src=../img/ouro15.png height=15> <font color=$color2> Você ganhou <b>$valor</b> créditos por realizar uma QUEST.</font>
	</td>
      </tr>";
}

if ($tipo==16){
echo "<tr bgcolor=$color height=23>
	<td width=5><B> </td>
	<td width=105><B>$data </td>
	<td style='text-align:left;' ><img src=img/Minus_Icon.png height=15> <font color=$color2> Foram retirados <b>$valor</b> créditos para transferir um Personagem.</font>
	</td>
      </tr>";
}

if ($tipo==17){
echo "<tr bgcolor=$color height=23>
	<td width=5><B> </td>
	<td width=105><B>$data </td>
	<td style='text-align:left;' ><img src=img/Minus_Icon.png height=15> <font color=$color2> Foram transferidos <b>$valor</b> créditos para outra conta.</font>
	</td>
      </tr>";
}

if ($tipo==18){
echo "<tr bgcolor=$color height=23>
	<td width=5><B> </td>
	<td width=105><B>$data </td>
	<td style='text-align:left;' ><img src=img/Minus_Icon.png height=15> <font color=$color2> Foram removidos <b>$valor</b> créditos para pagar a taxa de transferência de créditos.</font>
	</td>
      </tr>";
}

if ($tipo==19){
echo "<tr bgcolor=$color height=23>
	<td width=10><B> </td>
	<td width=120><B>$data </td>
	<td style='text-align:left;' ><img src=img/add.gif height=15> <font color=$color2> Foram transferidos <b>$valor</b> créditos para sua conta.</font>
	</td>
      </tr>";
}

}



if ($tabela==2){

if ($tipo==1){
echo "<tr bgcolor=$color height=23>
	<td width=10><B> </td>
	<td width=120><B>$data </td>
	<td style='text-align:left;'><img src=img/civilization-v-19.png width=15> <font color=darkblue> Foram adicionados <b>$valor</b> dias VIP.</font>
	
	</td>
      </tr>";}


if ($tipo==2){
echo "<tr bgcolor=$color height=23>
	<td width=10><B> </td>
	<td width=120><B>$data </td>
	<td style='text-align:left;'><img src=img/civilization-v-19.png width=15> <font color=darkblue> Foram adicionados <b>$valor</b> dias VIP.</font>
	
	</td>
      </tr>";}


if ($tipo==3){
echo "<tr bgcolor=$color height=23>
	<td width=10><B> </td>
	<td width=120><B>$data </td>
	<td style='text-align:left;'><img src=img/civilization-v-19.png width=15> <font color=darkblue> Foram adicionados <b>$valor</b> dias VIP.</font>
	
	</td>
      </tr>";}


if ($tipo==4){
echo "<tr bgcolor=$color height=23>
	<td width=10><B> </td>
	<td width=120><B>$data </td>
	<td style='text-align:left;'><img src=img/civilization-v-19.png width=15> <font color=darkblue> Foram adicionados <b>$valor</b> dias Super VIP.</font>
	
	</td>
      </tr>";}


if ($tipo==5){
echo "<tr bgcolor=$color height=23>
	<td width=10><B> </td>
	<td width=120><B>$data </td>
	<td style='text-align:left;'><img src=../img/ouro15.png height=15> <font color=darkblue> Você ganhou <b>$valor</b> dia $CONFIG_VIP1 por ficar 12 Hs online.</font>
	
	</td>
      </tr>";}

if ($tipo==6){
echo "<tr bgcolor=$color height=23>
	<td width=10><B> </td>
	<td width=120><B>$data </td>
	<td style='text-align:left;'><img src=../img/ouro15.png height=15> <font color=darkblue> Você ganhou <b>$valor</b> dias $CONFIG_VIP1.</font>
	
	</td>
      </tr>";}

if ($tipo==7){
echo "<tr bgcolor=$color height=23>
	<td width=10><B> </td>
	<td width=120><B>$data </td>
	<td style='text-align:left;'><img src=../img/ouro15.png height=15> <font color=darkblue> Você ganhou <b>$valor</b> dias $CONFIG_VIP2.</font>
	
	</td>
      </tr>";}

if ($tipo==8){
echo "<tr bgcolor=$color height=23>
	<td width=10><B> </td>
	<td width=120><B>$data </td>
	<td style='text-align:left;'><img src=../img/ouro15.png height=15> <font color=darkblue> Você ganhou <b>$valor</b> dias $CONFIG_VIP3.</font>
	
	</td>
      </tr>";}

if ($tipo==9){
echo "<tr bgcolor=$color height=23>
	<td width=10><B> </td>
	<td width=120><B>$data </td>
	<td style='text-align:left;'><img src=../img/ouro15.png height=15> <font color=darkblue> Você ganhou <b>$valor</b> dias VIP por ganhar um sorteio para usuários online.</font>
	
	</td>
      </tr>";}

}
if ($tipo==10){
echo "<tr bgcolor=$color height=23>
	<td width=5><B> </td>
	<td width=105><B>$data </td>
	<td style='text-align:left;'><img src=img/civilization-v-19.png width=15> <font color=#363636> Foram adicionados <b>$valor</b> dias Bonus VIP.</font>
	
	</td>
      </tr>";}

}






?>
</table>

      </div></td>
    </tr>
  </table>


</div></div>
