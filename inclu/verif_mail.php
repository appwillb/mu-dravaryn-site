		<meta http-equiv="content-type" content="text/html; charset=UTF-8" />
<?php

require("config_simples.php");

        $sql = "
                SELECT * FROM memb_info
                WHERE LOWER(mail_addr) = LOWER('$_POST[ps_email]') ";//monto a query

        $q = mssql_query( $sql );//executo a query

        if( mssql_num_rows( $q ) > 0 )//se retornar algum resultado
                echo '<img src=img/2.png title="Mail já cadastrado!" alt"Mail já cadastrado!">';
        else
                echo '<img src=img/ok.png title="Mail ainda não cadastrado!" alt"Mail ainda não cadastrado!">';
?>