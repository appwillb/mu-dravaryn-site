<link rel="stylesheet" href="css/menu_chars.css">

<div id="menu_chars">
    <ul class="menu_c">

<?

for($i=1;$i < $xex_s+1;++$i)
{
$row_s = mssql_fetch_row($result_s);

$nome        = $row_s[0];
$patente_num = $row_s[1];
$patenten    = $row_s[2];
$bloc_c      = $row_s[3];
$nivel_gm_medal= $row_s[4];
$char_s      = $row_s[5];
$diasb       = $row_s[6];
$mresets     = $row_s[7];
$resets      = $row_s[8];

$medal_char = $nome;
include("../inclu/medalhas.php");

include '../inclu/patentes.php';

$banido = '';
$banido2 = '';
if ($bloc_c==1) {
$banido = "style='color:red'";
$banido2= "<font color=red>( Personagem banido por $diasb dia(s). Motivo: $razao )";
}

echo "
        <li class='itemm$i' $banido><a href='#'><img src='../img/$img.jpg' class=redondo2><br> $nome <span> <img src=img/ButtonDown.png> </span></a>
            <ul class='item".$i."ul'>
        	<li><br>
<table border=0 width=900 cellSpacing=3 align=center>
    <tr>
	<td rowspan=2></td>
	<td colspan=6>Você selecionou o personagem  <b>$nome</b> $banido2 <br> <br>
	$medals</td>

    </tr>
    <tr>
      <td width=100 align=center><a href='../info_char_pop.php?easy=easy&name=$nome&painel=ok' target='main2'>[Informações]</a></td>
      <td width=110 align=center><a href='mudar_patente.php?char=$nome' target='main2'>[Mudar Patente]</a></td>
      <td width=160 align=center><a href='move.php?name=$nome' target='main2'>[Mover Personagem]</a></td>
      <td width=60 align=center><a href='quest_done_easy.php?personagem=$nome' target=main2>[Quests]</a></td>
      <td width=150 align=center><a href='resetar_masterskill.php?show=$nome' target='main2'>[Resetar Master Skill]</a></td>
	<td></td>
	<td></td>
	<td></td>
    </tr>
</tr>
</table>
</li>
            </ul>
        </li>";

echo "
<script>
	    menu_dcl  = $('.itemm$i');
	    menu_dcl.dblclick(function(e) {
	    $('#main2').attr('src', '../info_char_pop.php?name=$nome&painel=ok');
	    });
</script>";

}

	

if ($xex_s<1) {

echo "<li class='itemm1' $banido><a href='#'><img src='img/charelf.jpg' class=redondo2><br> Crie um Char <span> <img src=img/ButtonDown.png> </span></a>
<ul class='item1ul'><table border=0 width=600 cellSpacing=3 align=center>    <tr> <td><center> <bR><bR><b>Entre no jogo e crie um personagem.</td> </tr> </table>  </ul></li>";

}

if ($xex_s<2) {

echo "<li class='itemm2' $banido><a href='#'><img src='img/charsm.jpg' class=redondo2><br> Crie um Char <span> <img src=img/ButtonDown.png> </span></a>
<ul class='item2ul'><table border=0 width=600 cellSpacing=3 align=center>    <tr> <td><center> <bR><bR><b>Entre no jogo e crie um personagem.</td> </tr> </table>  </ul></li>";

}

if ($xex_s<3) {

echo "<li class='itemm3' $banido><a href='#'><img src='img/charbk.jpg' class=redondo2><br> Crie um Char <span> <img src=img/ButtonDown.png> </span></a>
<ul class='item3ul'><table border=0 width=600 cellSpacing=3 align=center>    <tr> <td><center> <bR><bR><b>Entre no jogo e crie um personagem.</td> </tr> </table>  </ul></li>";

}

if ($xex_s<4) {

echo "<li class='itemm4' $banido><a href='#'><img src='img/charmg.jpg' class=redondo2><br> Crie um Char <span> <img src=img/ButtonDown.png> </span></a>
<ul class='item4ul'><table border=0 width=600 cellSpacing=3 align=center>    <tr> <td><center> <bR><bR><b>Entre no jogo e crie um personagem.</td> </tr> </table>  </ul></li>";

}

if ($xex_s<5) {

echo "<li class='itemm5' $banido><a href='#'><img src='img/charelf.jpg' class=redondo2><br> Crie um Char <span> <img src=img/ButtonDown.png> </span></a>
<ul class='item5ul'><table border=0 width=600 cellSpacing=3 align=center>    <tr> <td><center> <bR><bR><b>Entre no jogo e crie um personagem.</td> </tr> </table>  </ul></li>";


}



?>

 </ul>
 
</div>

<!--initiate accordion-->
<script type="text/javascript">
	$(function() {
	
	    var menu_ul = $('.menu_C > li > ul'),
	           menu_a  = $('.menu_C > li > a');
	           menu_b  = $('.menu_C > li');
	    
	    menu_ul.hide();

		$( "#iframe" ).mouseover(function() {
  		menu_ul.hide();
	            menu_a.removeClass('active');


		});
	
	    menu_a.click(function(e) {
	        e.preventDefault();
	        if(!$(this).hasClass('active')) {
	            menu_a.removeClass('active');
	            menu_ul.filter(':visible').slideUp('normal');
	            $(this).addClass('active').next().stop(true,true).slideDown('normal');
	        } else {
	            $(this).removeClass('active');
	            $(this).next().stop(true,true).slideUp('normal');
	        }
	    });


	});
</script>