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

<br><Br><font size=3><b>LOGS CADASTROS</font></b><br><br>

<?
require("../inclu/config.php");
require("../inclu/cookie.php");

$NIVEL_ACESSO = 5;
require("../inclu/verif_nivel_gm.php");

$query_pe = "select top 30 memb___id,mail_addr,memb_name,CONVERT(VARCHAR(19),appl_days,120) as data_pg,mail_chek,code,ip_cadastro from memb_info order by appl_days desc";
$result_pe = mssql_query( $query_pe );

echo '<table border=0 cellSpacing=0 align=center>';
echo '
<thead>
  <tr>
	<th colspan=7>Ultimas 30 contas cadastradas</th>
  </th>
  <tr>
	<th width=80>Conta</th>
	<th width=80>E-mail</th>
	<th width=150>Nome</th>
	<th width=80>Mail check</th>
	<th width=50>Codigo</th>
	<th width=90>IP cadastro</th>
	<th width=130>Dia do cadastro</th>
  </tr>
</thead>';


for($i=0;$i < 30;++$i)
{
$row_pe = mssql_fetch_row($result_pe);

$login_pe =    $row_pe[0];
$mail_pe  =    $row_pe[1];
$name_pe  =    $row_pe[2];
$dia_pe   =    $row_pe[3];
$mailc    =    $row_pe[4];
$codigo   =    $row_pe[5];
$ipp      =    $row_pe[6];

$dia_pe = date_format(date_create("$row_pe[3]"), 'd-m-Y H:i');

if ($mailc ==1) $mailc='<font color=green>Ativo'; else $mailc='<font color=red>Inativo';

echo "<tr height=21>";
echo "<td>";
echo "<a href=editar_conta.php?loginlog=$login_pe>$login_pe</a>";
echo '</td><td>';
echo $mail_pe;
echo '</td><td>';
echo $name_pe;
echo '</td><td>';
echo $mailc;
echo '</td><td>';
echo "<a href=../../ativar_conta.php?login=$login_pe&codigo=$codigo target=_blank><b>$codigo</a>";
echo '</td><td>';
echo $ipp;
echo '</td><td>';
echo $dia_pe;
echo '</td></tr>';


}

?>
</div>