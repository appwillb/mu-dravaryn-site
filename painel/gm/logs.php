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
<br><Br><font size=3><b>LOGS DO SERVIDOR</font></b><br><br>

<?PHP
require("../inclu/config.php");
require("../inclu/cookie.php");

$NIVEL_ACESSO = 5;
require("../inclu/verif_nivel_gm.php");

?>
<a href=log_ban.php> LOG BANIDOS/DESBANIDOS</a> <BR><BR>

<a href=log_cadastros.php> LOG CADASTROS</a> <BR><BR>

<a href=log_gm.php> LOG EVENTOS(GM)</a> <BR><BR>

<a href=log_mail.php> LOG MUDAR E-MAIL</a> <BR><BR>

<a href=log_nome.php> LOG MUDAR NOME</a> <BR><BR>

<a href=log_rei.php> LOG REI DO MU</a> <BR><BR>

<a href=log_tcreditos.php> LOG TRANSFERIR CREDITOS</a> <BR><BR>

<a href=log_tpersonagem.php> LOG TRANSFERIR PERSONAGEM</a> <BR><BR>

</div>