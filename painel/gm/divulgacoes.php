<head>
  <link type="text/css" rel="stylesheet" href="../css/paginas.css">

        <script type="text/javascript" src="../../js/jquery-1.3.2.min.js"></script>

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

<br><Br><font size=3><b>DIVULGAÇÕES</font></b><br><br>

<?
require("../inclu/config.php");
require("../inclu/cookie.php");

$NIVEL_ACESSO = 5;

require("../inclu/verif_nivel_gm.php");

if ($_POST) {

$iddv  = $_POST[iddv];
$add   = $_POST[add];
$logdv = $_POST[log];

if ($add < 0) {
mssql_query("UPDATE MK_DV SET invalida=1 where id = '$iddv'");
}
elseif ($add > 0 )
{
mssql_query("UPDATE MK_DV SET valor=valor+'$add' where id = '$iddv'");
mssql_query("UPDATE CashShopData SET wcoinc=wcoinc+'$add' where accountid = '$logdv'");
}

}
?>


<center><table border=0 cellSpacing=0>
  <thead>
    <tr>
      <th width=50><center><b>Data</th>
      <th width=90 class=bgtr><center><b>Login</th>
      <th width=250 class=bgtr><center><b><center>Link:</th>
      <th width=80 class=bgtr><center><b><center>Créditos:</th>
      <th width=80 class=bgtr><center><b><center>Situação:</th>
      <th width=80><center><b><center>Adicionar:</th>
    </tr>
  </thead>

                  <?

$query=mssql_query("select TOP 200 link,valor,CONVERT(VARCHAR(19),data,120) as data, invalida, login, id from mk_dv order by id desc");
while($row=mssql_fetch_row($query)){
$link  	=$row[0];
$valor 	=$row[1];
$data 	=$row[2];
$inv 	=$row[3];
$logdv 	=$row[4];
$iddv 	=$row[5];

$data = date_format(date_create("$data"), 'd-m-Y');

if ($valor > 0)
	{
		$situacao = '<font color=green>Confirmado';
	}
else 	
	{
		$situacao = '<font color=blue>Pendente';
	}

if ($inv == 1)
	{
		$situacao = '<font color=red>Inválido';
	}


?>

<form name='form1' method='post' action="?pagina=<? echo $pagina;?>&post=ok">

	<input type='hidden' name='log' value='<? echo $logdv;?>'>
	<input type='hidden' name='iddv' value='<? echo $iddv;?>'>

		<tr>
                    <td><?=$data?></td>
                    <td><?=$logdv?></td>
                    <td style='text-align:left;'><a href=<?=$link?> target=_blank><?=$link?></a></td>
                    <td><center><?=$valor?></td>
                    <td><center><?=$situacao?></td>
			<td><center><select name='add' id='add' onchange="this.form.submit();">
			 <option value='0'> Selecione </option>
			 <option value='-1'> Inválida </option>
			 <option value='1'> 1 crédito  </option>
			 <option value='2'> 2 crédito  </option>
			 <option value='3'> 3 crédito  </option>
			 <option value='4'> 4 crédito  </option>
			 <option value='5'> 5 crédito  </option>
			 <option value='6'> 6 crédito  </option>
			 <option value='7'> 7 crédito  </option>
			 <option value='8'> 8 crédito  </option>
			 <option value='9'> 9 crédito  </option>
			 <option value='10'> 10 crédito  </option>
			 <option value='15'> 15 crédito  </option>
			</select>
		    </td>

		     </tr>
</form>
                    <? } ?>
                </table>

</div>