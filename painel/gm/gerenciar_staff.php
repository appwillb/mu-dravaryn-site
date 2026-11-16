<head>
  <link type="text/css" rel="stylesheet" href="../css/paginas.css">

        <script type="text/javascript" src="../../js/jquery-1.3.2.min.js"></script>

	<script type="text/javascript">
		$("#main2", window.parent.document).height(1300);
        function tamanho(){
		$("#main2", window.parent.document).height($("#tamanho").height() + 40);
	    }
        </script>
</head>
<body leftmargin='0' topmargin='0' onload="tamanho()">

<center>
<div id="tamanho">
<br><Br><font size=3><b>GERENCIAR STAFF</font></b><br><br>

<?PHP
require("../inclu/config.php");
require("../inclu/cookie.php");

$NIVEL_ACESSO = 4;
require("../inclu/verif_nivel_gm.php");

if($_GET[remover]){

$loginlog         = $_GET[loginlog];
$loginchar        = $_GET[loginchar];

if (empty($loginlog) || empty($loginlog))   {
echo '<script language="Javascript">alert("ERRO: Personagem não removido!!")</script>';
}

else {

mssql_query("UPDATE CHARACTER SET nivel_gm=0 where accountid='$loginlog' and name = '$loginchar'");

echo '<script language="Javascript">alert("Personagem removido da staff!!")</script>';

}
}

if($_GET[adicionar]){

$loginchar      = $_POST[loginchar];
$nivel        	= $_POST[nivel];

$acc_char 	= mssql_fetch_row(mssql_query("Select accountid,name From character WHERE name = '$loginchar'"));
$loginlog 	= $acc_char[0];

if (empty($loginlog))   {
	echo '<script language="Javascript">alert("ERRO: Esse personagem não existe!!")</script>';
}
elseif (empty($loginlog) || empty($loginlog) || empty($nivel))   {
	echo '<script language="Javascript">alert("ERRO: Membro não adicionado na staff!!")</script>';
}
elseif ($nivel < 1 || $nivel > 5)
{
	echo '<script language="Javascript">alert("ERRO: Personagem não editado!!")</script>';
}
else {

mssql_query("UPDATE CHARACTER SET nivel_gm=$nivel where accountid='$loginlog' and name = '$loginchar'");

echo '<script language="Javascript">alert("Personagem adicionado na staff!!")</script>';

}
}

if($_GET[editar]){

$loginlog       = $_POST[loginlog];
$loginchar      = $_POST[loginchar];
$nivel        	= $_POST[nivel];

if (empty($loginlog) || empty($loginchar) || empty($nivel))   {
	echo '<script language="Javascript">alert("ERRO: Personagem não editado!!")</script>';
}
elseif ($nivel < 1 || $nivel > 5)
{
	echo '<script language="Javascript">alert("ERRO: Personagem não editado!!")</script>';
}
else {

mssql_query("UPDATE CHARACTER SET nivel_gm=$nivel where accountid='$loginlog' and name = '$loginchar'");

echo '<script language="Javascript">alert("Personagem editado com sucesso!!")</script>';

}
}

?>

<table width=500 cellspacing=0>
<thead>
  <tr>
	<th> Adicionar Membro </th>
  </tr>
</thead>

<tr>
	<td>

		<form name='form1' method='post' action='?adicionar=ok'>
		  <br><input name='loginchar' type='text' id='loginchar' maxlength='20' value='Personagem' onfocus="if(this.value  == 'Personagem') { this.value = ''; } " onblur="if(this.value == '') { this.value = 'Personagem'; }" style='text-align:center'>
		  <br><br><SELECT name=nivel>
			<option value='0'>-- Escolha o nível --</option>
			<option value='1'> Ajudante </option>
			<option value='2'> Sub-GameMaster </option>
			<option value='3'> GameMaster </option>
			<option value='4'> Sub-Administrador </option>
			<option value='5'> Administrador </option>

			</SELECT>
		  <br><br><input type='submit' name='Submit' value='Continuar'> 
		</form>
	</td>
</tr>
</table><bR><Br>


<table width=500 cellspacing=0>
<thead>
<tr>
  <th Colspan=4>Membros da Staff:</th>
</tr>
<tr>
      <th> Login  </th>
      <th> Nome   </th>
      <th> Nível </th>
      <th> Editar </th>
</tr>

</thead>

<?php

$query = "Select accountid, name, nivel_gm From character where nivel_gm > 0 and accountid <> '$login' order by nivel_gm desc";
$result = mssql_query( $query );

$xex = mssql_num_rows($result);

if ($xex <= 0 ) {
echo "
 <tr>
  <td colspan=4> Nenhum membro na staff</td>
 </tr>
";
}

for($i=0;$i < $xex;++$i)
{
$row = mssql_fetch_row($result);

$login_gm    =   $row[0];
$char_gm     =   $row[1];
$nivel       =   $row[2];

$sele1 = '';
$sele2 = '';

echo "
<form name='form1' method='post' action='?editar=ok'>
<input type='hidden' name='loginlog' value='$login_gm'>
<input type='hidden' name='loginchar' value='$char_gm'>

<tr>
<td><a href='editar_conta.php?loginlog=$login_gm'><b>$login_gm</a></td>
<td><a href='editar_conta.php?loginchar=$char_gm'><b>$char_gm</a></td>
<td><select name='nivel' id='nivel'>
 <option value='1' ".($nivel == 1 ? 'selected' : '')."> AJUDANTE  </option>
 <option value='2' ".($nivel == 2 ? 'selected' : '')."> SUB-GM  </option>
 <option value='3' ".($nivel == 3 ? 'selected' : '')."> GM  </option>
 <option value='4' ".($nivel == 4 ? 'selected' : '')."> SUB-ADM  </option>
 <option value='5' ".($nivel == 5 ? 'selected' : '')."> ADM  </option>
</select> 
</td>
<td><input type='image' src='../img/save.png' name='Submit' value='Continuar' style='border:0;background:transparent;'></form> &nbsp; &nbsp;
<a href='?remover=ok&loginlog=$login_gm&loginchar=$char_gm'><img src='../img/excluir.png'></a></td>
</tr>";

}

echo "</table><BR><BR>";
