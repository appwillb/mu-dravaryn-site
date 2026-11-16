<?php
require("config_simples.php");

        $sql = "
                SELECT * FROM memb_info
                WHERE LOWER(memb___id) = LOWER('$_POST[ps_loginname]') ";//monto a query

        $q = mssql_query( $sql );//executo a query

        if( mssql_num_rows( $q ) > 0 )//se retornar algum resultado
                echo '<img src=img/2.png title="Conta já cadastrada!" alt"Conta já cadastrada!">';
        else
                echo '<img src=img/ok.png title="Conta ainda não cadastrada!" alt"Conta ainda não cadastrada!">';
?>