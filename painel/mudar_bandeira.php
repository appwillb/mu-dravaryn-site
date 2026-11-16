<head>
  <link type="text/css" rel="stylesheet" href="css/paginas.css">
        <script type="text/javascript" src="../js/jquery-1.3.2.min.js"></script>

	<script type="text/javascript">
		$("#main2", window.parent.document).height(1200);
        function tamanho(){
		$("#main2", window.parent.document).height($("#tamanho").height() + 40);
	    }
        </script>

</head>
<body style="background-color: transparent" leftmargin='0' topmargin='0' onload="tamanho()">

<center>
<div id="tamanho">

<center><bR><BR><font size=3><b> MUDAR BANDEIRA <bR><BR></font></b>

<?
require("inclu/config.php");
require("inclu/cookie.php");

echo "Escolha a bandeira da sua nacionalidade!<br><bR>
";

if ($_GET[salvar]) {

$personagem = $_GET[show];
$bandeira   = $_POST[pate];

if     (!$bandeira) {
mssql_query("UPDATE MEMB_INFO SET bandeira=null where memb___id='$login'");
}
else {

mssql_query("UPDATE MEMB_INFO SET bandeira='$bandeira' where memb___id='$login'");

echo "<meta http-equiv='refresh' content='0; url=principal.php'>";
echo '<script language="Javascript">alert("Salvo com sucesso!!")</script>';
die();


}
}

$row = mssql_fetch_row(mssql_query("select top 1 dbo.fn_bandeira('$login')"));
$band = $row[0];

?>

<form name=formulario  method="post" action="?salvar=ok">
<table width=800 style='border:0;'>

 <tr>
	<td> </td>
 </tr>

 <tr>
	<td><center><img src="../img/bandeiras30/ad.png"> <br> <input name="pate" type="radio" class ="radio" value="ad" <?php if ($band =='ad') echo 'checked';?>></td>
	<td><center><img src="../img/bandeiras30/ae.png"> <br> <input name="pate" type="radio" class ="radio" value="ae" <?php if ($band =='ae') echo 'checked';?>></td>
	<td><center><img src="../img/bandeiras30/af.png"> <br> <input name="pate" type="radio" class ="radio" value="af" <?php if ($band =='af') echo 'checked';?>></td>
	<td><center><img src="../img/bandeiras30/ag.png"> <br> <input name="pate" type="radio" class ="radio" value="ag" <?php if ($band =='ag') echo 'checked';?>></td>
	<td><center><img src="../img/bandeiras30/al.png"> <br> <input name="pate" type="radio" class ="radio" value="al" <?php if ($band =='al') echo 'checked';?>></td>
	<td><center><img src="../img/bandeiras30/am.png"> <br> <input name="pate" type="radio" class ="radio" value="am" <?php if ($band =='am') echo 'checked';?>></td>
	<td><center><img src="../img/bandeiras30/ao.png"> <br> <input name="pate" type="radio" class ="radio" value="ao" <?php if ($band =='ao') echo 'checked';?>></td>
	<td><center><img src="../img/bandeiras30/ar.png">	<br> <input name="pate" type="radio" class ="radio" value="ar" <?php if ($band =='ar') echo 'checked';?>></td>
	<td><center><img src="../img/bandeiras30/at.png">	<br> <input name="pate" type="radio" class ="radio" value="at" <?php if ($band =='at') echo 'checked';?>></td>
	<td><center><img src="../img/bandeiras30/au.png">	<br> <input name="pate" type="radio" class ="radio" value="au" <?php if ($band =='au') echo 'checked';?>></td>
	<td><center><img src="../img/bandeiras30/az.png">	<br> <input name="pate" type="radio" class ="radio" value="az" <?php if ($band =='az') echo 'checked';?>></td>
	<td><center><img src="../img/bandeiras30/ba.png">	<br> <input name="pate" type="radio" class ="radio" value="ba" <?php if ($band =='ba') echo 'checked';?>></td>
	<td><center><img src="../img/bandeiras30/bb.png">	<br> <input name="pate" type="radio" class ="radio" value="bb" <?php if ($band =='bb') echo 'checked';?>></td>
	<td><center><img src="../img/bandeiras30/bd.png">	<br> <input name="pate" type="radio" class ="radio" value="bd" <?php if ($band =='bd') echo 'checked';?>></td>

 </tr>

 <tr>
	<td> </td>
 </tr>

 <tr>
	<td><center><img src="../img/bandeiras30/be.png">	<br> <input name="pate" type="radio" class ="radio" value="be" <?php if ($band =='be') echo 'checked';?>></td>
	<td><center><img src="../img/bandeiras30/bf.png">	<br> <input name="pate" type="radio" class ="radio" value="bf" <?php if ($band =='bf') echo 'checked';?>></td>
	<td><center><img src="../img/bandeiras30/bg.png">	<br> <input name="pate" type="radio" class ="radio" value="bg" <?php if ($band =='bg') echo 'checked';?>></td>
	<td><center><img src="../img/bandeiras30/bh.png">	<br> <input name="pate" type="radio" class ="radio" value="bh" <?php if ($band =='bh') echo 'checked';?>></td>
	<td><center><img src="../img/bandeiras30/bi.png">	<br> <input name="pate" type="radio" class ="radio" value="bi" <?php if ($band =='bi') echo 'checked';?>></td>
	<td><center><img src="../img/bandeiras30/bj.png">	<br> <input name="pate" type="radio" class ="radio" value="bj" <?php if ($band =='bj') echo 'checked';?>></td>
	<td><center><img src="../img/bandeiras30/bn.png">	<br> <input name="pate" type="radio" class ="radio" value="bn" <?php if ($band =='bn') echo 'checked';?>></td>
	<td><center><img src="../img/bandeiras30/bo.png">	<br> <input name="pate" type="radio" class ="radio" value="bo" <?php if ($band =='bo') echo 'checked';?>></td>
	<td><center><img src="../img/bandeiras30/br.png">	<br> <input name="pate" type="radio" class ="radio" value="br" <?php if ($band =='br') echo 'checked';?>></td>
	<td><center><img src="../img/bandeiras30/bs.png">	<br> <input name="pate" type="radio" class ="radio" value="bs" <?php if ($band =='bs') echo 'checked';?>></td>
	<td><center><img src="../img/bandeiras30/bt.png">	<br> <input name="pate" type="radio" class ="radio" value="bt" <?php if ($band =='bt') echo 'checked';?>></td>
	<td><center><img src="../img/bandeiras30/bw.png">	<br> <input name="pate" type="radio" class ="radio" value="bw" <?php if ($band =='bw') echo 'checked';?>></td>
	<td><center><img src="../img/bandeiras30/by.png">	<br> <input name="pate" type="radio" class ="radio" value="by" <?php if ($band =='by') echo 'checked';?>></td>
	<td><center><img src="../img/bandeiras30/bz.png">	<br> <input name="pate" type="radio" class ="radio" value="bz" <?php if ($band =='bz') echo 'checked';?>></td>
 </tr>

 <tr>
	<td> </td>
 </tr>

 <tr>
	<td><center><img src="../img/bandeiras30/ca.png">	<br> <input name="pate" type="radio" class ="radio" value="ca" <?php if ($band =='ca') echo 'checked';?>></td>
	<td><center><img src="../img/bandeiras30/cd.png">	<br> <input name="pate" type="radio" class ="radio" value="cd" <?php if ($band =='cd') echo 'checked';?>></td>
	<td><center><img src="../img/bandeiras30/cf.png">	<br> <input name="pate" type="radio" class ="radio" value="cf" <?php if ($band =='cf') echo 'checked';?>></td>
	<td><center><img src="../img/bandeiras30/cg.png">	<br> <input name="pate" type="radio" class ="radio" value="cg" <?php if ($band =='cg') echo 'checked';?>></td>
	<td><center><img src="../img/bandeiras30/ch.png">	<br> <input name="pate" type="radio" class ="radio" value="ch" <?php if ($band =='ch') echo 'checked';?>></td>
	<td><center><img src="../img/bandeiras30/ci.png">	<br> <input name="pate" type="radio" class ="radio" value="ci" <?php if ($band =='ci') echo 'checked';?>></td>
	<td><center><img src="../img/bandeiras30/cl.png">	<br> <input name="pate" type="radio" class ="radio" value="cl" <?php if ($band =='cl') echo 'checked';?>></td>

	<td><center><img src="../img/bandeiras30/cm.png">	<br> <input name="pate" type="radio" class ="radio" value="cm" <?php if ($band =='cm') echo 'checked';?>></td>
	<td><center><img src="../img/bandeiras30/cn.png">	<br> <input name="pate" type="radio" class ="radio" value="cn" <?php if ($band =='cn') echo 'checked';?>></td>
	<td><center><img src="../img/bandeiras30/co.png">	<br> <input name="pate" type="radio" class ="radio" value="co" <?php if ($band =='co') echo 'checked';?>></td>
	<td><center><img src="../img/bandeiras30/cr.png">	<br> <input name="pate" type="radio" class ="radio" value="cr" <?php if ($band =='cr') echo 'checked';?>></td>
	<td><center><img src="../img/bandeiras30/cu.png">	<br> <input name="pate" type="radio" class ="radio" value="cu" <?php if ($band =='cu') echo 'checked';?>></td>
	<td><center><img src="../img/bandeiras30/cv.png">	<br> <input name="pate" type="radio" class ="radio" value="cv" <?php if ($band =='cv') echo 'checked';?>></td>
	<td><center><img src="../img/bandeiras30/cy.png">	<br> <input name="pate" type="radio" class ="radio" value="cy" <?php if ($band =='cy') echo 'checked';?>></td>
 </tr>

 <tr>
	<td> </td>
 </tr>

 <tr>
	<td><center><img src="../img/bandeiras30/cz.png">	<br> <input name="pate" type="radio" class ="radio" value="cz" <?php if ($band =='cz') echo 'checked';?>></td>
	<td><center><img src="../img/bandeiras30/de.png">	<br> <input name="pate" type="radio" class ="radio" value="de" <?php if ($band =='de') echo 'checked';?>></td>
	<td><center><img src="../img/bandeiras30/dj.png">	<br> <input name="pate" type="radio" class ="radio" value="dj" <?php if ($band =='dj') echo 'checked';?>></td>
	<td><center><img src="../img/bandeiras30/dk.png">	<br> <input name="pate" type="radio" class ="radio" value="dk" <?php if ($band =='dk') echo 'checked';?>></td>
	<td><center><img src="../img/bandeiras30/dm.png">	<br> <input name="pate" type="radio" class ="radio" value="dm" <?php if ($band =='dm') echo 'checked';?>></td>
	<td><center><img src="../img/bandeiras30/do.png">	<br> <input name="pate" type="radio" class ="radio" value="do" <?php if ($band =='do') echo 'checked';?>></td>
	<td><center><img src="../img/bandeiras30/dz.png">	<br> <input name="pate" type="radio" class ="radio" value="dz" <?php if ($band =='dz') echo 'checked';?>></td>

	<td><center><img src="../img/bandeiras30/ec.png">	<br> <input name="pate" type="radio" class ="radio" value="ec" <?php if ($band =='ec') echo 'checked';?>></td>
	<td><center><img src="../img/bandeiras30/ee.png">	<br> <input name="pate" type="radio" class ="radio" value="ee" <?php if ($band =='ee') echo 'checked';?>></td>
	<td><center><img src="../img/bandeiras30/eg.png">	<br> <input name="pate" type="radio" class ="radio" value="eg" <?php if ($band =='eg') echo 'checked';?>></td>
	<td><center><img src="../img/bandeiras30/eh.png">	<br> <input name="pate" type="radio" class ="radio" value="eh" <?php if ($band =='eh') echo 'checked';?>></td>
	<td><center><img src="../img/bandeiras30/er.png">	<br> <input name="pate" type="radio" class ="radio" value="er" <?php if ($band =='er') echo 'checked';?>></td>
	<td><center><img src="../img/bandeiras30/es.png">	<br> <input name="pate" type="radio" class ="radio" value="es" <?php if ($band =='es') echo 'checked';?>></td>
	<td><center><img src="../img/bandeiras30/et.png">	<br> <input name="pate" type="radio" class ="radio" value="et" <?php if ($band =='et') echo 'checked';?>></td>
 </tr>

 <tr>
	<td> </td>
 </tr>

 <tr>
	<td><center><img src="../img/bandeiras30/fi.png">	<br> <input name="pate" type="radio" class ="radio" value="fi" <?php if ($band =='fi') echo 'checked';?>></td>
	<td><center><img src="../img/bandeiras30/fj.png">	<br> <input name="pate" type="radio" class ="radio" value="fj" <?php if ($band =='fj') echo 'checked';?>></td>
	<td><center><img src="../img/bandeiras30/fm.png">	<br> <input name="pate" type="radio" class ="radio" value="fm" <?php if ($band =='fm') echo 'checked';?>></td>
	<td><center><img src="../img/bandeiras30/fr.png">	<br> <input name="pate" type="radio" class ="radio" value="fr" <?php if ($band =='fr') echo 'checked';?>></td>
	<td><center><img src="../img/bandeiras30/ga.png">	<br> <input name="pate" type="radio" class ="radio" value="ga" <?php if ($band =='ga') echo 'checked';?>></td>
	<td><center><img src="../img/bandeiras30/gb.png">	<br> <input name="pate" type="radio" class ="radio" value="gb" <?php if ($band =='gb') echo 'checked';?>></td>
	<td><center><img src="../img/bandeiras30/gd.png">	<br> <input name="pate" type="radio" class ="radio" value="gd" <?php if ($band =='gd') echo 'checked';?>></td>

	<td><center><img src="../img/bandeiras30/ge.png">	<br> <input name="pate" type="radio" class ="radio" value="ge" <?php if ($band =='ge') echo 'checked';?>></td>
	<td><center><img src="../img/bandeiras30/gh.png">	<br> <input name="pate" type="radio" class ="radio" value="gh" <?php if ($band =='gh') echo 'checked';?>></td>
	<td><center><img src="../img/bandeiras30/gm.png">	<br> <input name="pate" type="radio" class ="radio" value="gm" <?php if ($band =='gm') echo 'checked';?>></td>
	<td><center><img src="../img/bandeiras30/gn.png">	<br> <input name="pate" type="radio" class ="radio" value="gn" <?php if ($band =='gn') echo 'checked';?>></td>
	<td><center><img src="../img/bandeiras30/gq.png">	<br> <input name="pate" type="radio" class ="radio" value="gq" <?php if ($band =='gq') echo 'checked';?>></td>
	<td><center><img src="../img/bandeiras30/gr.png">	<br> <input name="pate" type="radio" class ="radio" value="gr" <?php if ($band =='gr') echo 'checked';?>></td>
	<td><center><img src="../img/bandeiras30/gt.png">	<br> <input name="pate" type="radio" class ="radio" value="gt" <?php if ($band =='gt') echo 'checked';?>></td>
 </tr>

 <tr>
	<td> </td>
 </tr>

 <tr>
	<td><center><img src="../img/bandeiras30/gw.png">	<br> <input name="pate" type="radio" class ="radio" value="gw" <?php if ($band =='gw') echo 'checked';?>></td>
	<td><center><img src="../img/bandeiras30/gy.png">	<br> <input name="pate" type="radio" class ="radio" value="gy" <?php if ($band =='gy') echo 'checked';?>></td>
	<td><center><img src="../img/bandeiras30/hn.png">	<br> <input name="pate" type="radio" class ="radio" value="hn" <?php if ($band =='hn') echo 'checked';?>></td>
	<td><center><img src="../img/bandeiras30/hr.png">	<br> <input name="pate" type="radio" class ="radio" value="hr" <?php if ($band =='hr') echo 'checked';?>></td>
	<td><center><img src="../img/bandeiras30/ht.png">	<br> <input name="pate" type="radio" class ="radio" value="ht" <?php if ($band =='ht') echo 'checked';?>></td>
	<td><center><img src="../img/bandeiras30/hu.png">	<br> <input name="pate" type="radio" class ="radio" value="hu" <?php if ($band =='hu') echo 'checked';?>></td>
	<td><center><img src="../img/bandeiras30/id.png">	<br> <input name="pate" type="radio" class ="radio" value="id" <?php if ($band =='id') echo 'checked';?>></td>

	<td><center><img src="../img/bandeiras30/ie.png">	<br> <input name="pate" type="radio" class ="radio" value="ie" <?php if ($band =='ie') echo 'checked';?>></td>
	<td><center><img src="../img/bandeiras30/il.png">	<br> <input name="pate" type="radio" class ="radio" value="il" <?php if ($band =='il') echo 'checked';?>></td>
	<td><center><img src="../img/bandeiras30/in.png">	<br> <input name="pate" type="radio" class ="radio" value="in" <?php if ($band =='in') echo 'checked';?>></td>
	<td><center><img src="../img/bandeiras30/iq.png">	<br> <input name="pate" type="radio" class ="radio" value="iq" <?php if ($band =='iq') echo 'checked';?>></td>
	<td><center><img src="../img/bandeiras30/ir.png">	<br> <input name="pate" type="radio" class ="radio" value="ir" <?php if ($band =='ir') echo 'checked';?>></td>
	<td><center><img src="../img/bandeiras30/is.png">	<br> <input name="pate" type="radio" class ="radio" value="is" <?php if ($band =='is') echo 'checked';?>></td>
	<td><center><img src="../img/bandeiras30/it.png">	<br> <input name="pate" type="radio" class ="radio" value="it" <?php if ($band =='it') echo 'checked';?>></td>
 </tr>

 <tr>
	<td> </td>
 </tr>

 <tr>
	<td><center><img src="../img/bandeiras30/jm.png">	<br> <input name="pate" type="radio" class ="radio" value="jm" <?php if ($band =='jm') echo 'checked';?>></td>
	<td><center><img src="../img/bandeiras30/jo.png">	<br> <input name="pate" type="radio" class ="radio" value="jo" <?php if ($band =='jo') echo 'checked';?>></td>
	<td><center><img src="../img/bandeiras30/jp.png">	<br> <input name="pate" type="radio" class ="radio" value="jp" <?php if ($band =='jp') echo 'checked';?>></td>
	<td><center><img src="../img/bandeiras30/ke.png">	<br> <input name="pate" type="radio" class ="radio" value="ke" <?php if ($band =='ke') echo 'checked';?>></td>
	<td><center><img src="../img/bandeiras30/kg.png">	<br> <input name="pate" type="radio" class ="radio" value="kg" <?php if ($band =='kg') echo 'checked';?>></td>
	<td><center><img src="../img/bandeiras30/kh.png">	<br> <input name="pate" type="radio" class ="radio" value="kh" <?php if ($band =='kh') echo 'checked';?>></td>
	<td><center><img src="../img/bandeiras30/km.png">	<br> <input name="pate" type="radio" class ="radio" value="km" <?php if ($band =='km') echo 'checked';?>></td>

	<td><center><img src="../img/bandeiras30/kn.png">	<br> <input name="pate" type="radio" class ="radio" value="kn" <?php if ($band =='kn') echo 'checked';?>></td>
	<td><center><img src="../img/bandeiras30/kp.png">	<br> <input name="pate" type="radio" class ="radio" value="kp" <?php if ($band =='kp') echo 'checked';?>></td>
	<td><center><img src="../img/bandeiras30/kr.png">	<br> <input name="pate" type="radio" class ="radio" value="kr" <?php if ($band =='kr') echo 'checked';?>></td>
	<td><center><img src="../img/bandeiras30/ks.png">	<br> <input name="pate" type="radio" class ="radio" value="ks" <?php if ($band =='ks') echo 'checked';?>></td>
	<td><center><img src="../img/bandeiras30/kw.png">	<br> <input name="pate" type="radio" class ="radio" value="kw" <?php if ($band =='kw') echo 'checked';?>></td>
	<td><center><img src="../img/bandeiras30/kz.png">	<br> <input name="pate" type="radio" class ="radio" value="kz" <?php if ($band =='kz') echo 'checked';?>></td>
	<td><center><img src="../img/bandeiras30/la.png">	<br> <input name="pate" type="radio" class ="radio" value="la" <?php if ($band =='la') echo 'checked';?>></td>
 </tr>

 <tr>
	<td> </td>
 </tr>

 <tr>
	<td><center><img src="../img/bandeiras30/lb.png">	<br> <input name="pate" type="radio" class ="radio" value="lb" <?php if ($band =='lb') echo 'checked';?>></td>
	<td><center><img src="../img/bandeiras30/lc.png">	<br> <input name="pate" type="radio" class ="radio" value="lc" <?php if ($band =='lc') echo 'checked';?>></td>
	<td><center><img src="../img/bandeiras30/li.png">	<br> <input name="pate" type="radio" class ="radio" value="li" <?php if ($band =='li') echo 'checked';?>></td>
	<td><center><img src="../img/bandeiras30/lk.png">	<br> <input name="pate" type="radio" class ="radio" value="lk" <?php if ($band =='lk') echo 'checked';?>></td>
	<td><center><img src="../img/bandeiras30/lr.png">	<br> <input name="pate" type="radio" class ="radio" value="lr" <?php if ($band =='lr') echo 'checked';?>></td>
	<td><center><img src="../img/bandeiras30/ls.png">	<br> <input name="pate" type="radio" class ="radio" value="ls" <?php if ($band =='ls') echo 'checked';?>></td>
	<td><center><img src="../img/bandeiras30/lt.png">	<br> <input name="pate" type="radio" class ="radio" value="lt" <?php if ($band =='lt') echo 'checked';?>></td>

	<td><center><img src="../img/bandeiras30/lu.png">	<br> <input name="pate" type="radio" class ="radio" value="lu" <?php if ($band =='lu') echo 'checked';?>></td>
	<td><center><img src="../img/bandeiras30/lv.png">	<br> <input name="pate" type="radio" class ="radio" value="lv" <?php if ($band =='lv') echo 'checked';?>></td>
	<td><center><img src="../img/bandeiras30/ly.png">	<br> <input name="pate" type="radio" class ="radio" value="ly" <?php if ($band =='ly') echo 'checked';?>></td>
	<td><center><img src="../img/bandeiras30/ma.png">	<br> <input name="pate" type="radio" class ="radio" value="ma" <?php if ($band =='ma') echo 'checked';?>></td>
	<td><center><img src="../img/bandeiras30/mc.png">	<br> <input name="pate" type="radio" class ="radio" value="mc" <?php if ($band =='mc') echo 'checked';?>></td>
	<td><center><img src="../img/bandeiras30/md.png">	<br> <input name="pate" type="radio" class ="radio" value="md" <?php if ($band =='md') echo 'checked';?>></td>
	<td><center><img src="../img/bandeiras30/me.png">	<br> <input name="pate" type="radio" class ="radio" value="me" <?php if ($band =='me') echo 'checked';?>></td>
 </tr>

 <tr>
	<td> </td>
 </tr>

 <tr>
	<td><center><img src="../img/bandeiras30/mg.png">	<br> <input name="pate" type="radio" class ="radio" value="mg" <?php if ($band =='mg') echo 'checked';?>></td>
	<td><center><img src="../img/bandeiras30/mh.png">	<br> <input name="pate" type="radio" class ="radio" value="mh" <?php if ($band =='mh') echo 'checked';?>></td>
	<td><center><img src="../img/bandeiras30/mk.png">	<br> <input name="pate" type="radio" class ="radio" value="mk" <?php if ($band =='mk') echo 'checked';?>></td>
	<td><center><img src="../img/bandeiras30/ml.png">	<br> <input name="pate" type="radio" class ="radio" value="ml" <?php if ($band =='ml') echo 'checked';?>></td>
	<td><center><img src="../img/bandeiras30/mm.png">	<br> <input name="pate" type="radio" class ="radio" value="mm" <?php if ($band =='mm') echo 'checked';?>></td>
	<td><center><img src="../img/bandeiras30/mn.png">	<br> <input name="pate" type="radio" class ="radio" value="mn" <?php if ($band =='mn') echo 'checked';?>></td>
	<td><center><img src="../img/bandeiras30/mr.png">	<br> <input name="pate" type="radio" class ="radio" value="mr" <?php if ($band =='mr') echo 'checked';?>></td>

	<td><center><img src="../img/bandeiras30/mt.png">	<br> <input name="pate" type="radio" class ="radio" value="mt" <?php if ($band =='mt') echo 'checked';?>></td>
	<td><center><img src="../img/bandeiras30/mu.png">	<br> <input name="pate" type="radio" class ="radio" value="mu" <?php if ($band =='mu') echo 'checked';?>></td>
	<td><center><img src="../img/bandeiras30/mv.png">	<br> <input name="pate" type="radio" class ="radio" value="mv" <?php if ($band =='mv') echo 'checked';?>></td>
	<td><center><img src="../img/bandeiras30/mw.png">	<br> <input name="pate" type="radio" class ="radio" value="mw" <?php if ($band =='mw') echo 'checked';?>></td>
	<td><center><img src="../img/bandeiras30/mx.png">	<br> <input name="pate" type="radio" class ="radio" value="mx" <?php if ($band =='mx') echo 'checked';?>></td>
	<td><center><img src="../img/bandeiras30/my.png">	<br> <input name="pate" type="radio" class ="radio" value="my" <?php if ($band =='my') echo 'checked';?>></td>
	<td><center><img src="../img/bandeiras30/mz.png">	<br> <input name="pate" type="radio" class ="radio" value="mz" <?php if ($band =='mz') echo 'checked';?>></td>
 </tr>

 <tr>
	<td> </td>
 </tr>

 <tr>
	<td><center><img src="../img/bandeiras30/na.png">	<br> <input name="pate" type="radio" class ="radio" value="na" <?php if ($band =='na') echo 'checked';?>></td>
	<td><center><img src="../img/bandeiras30/ne.png">	<br> <input name="pate" type="radio" class ="radio" value="ne" <?php if ($band =='ne') echo 'checked';?>></td>
	<td><center><img src="../img/bandeiras30/ng.png">	<br> <input name="pate" type="radio" class ="radio" value="ng" <?php if ($band =='ng') echo 'checked';?>></td>
	<td><center><img src="../img/bandeiras30/ni.png">	<br> <input name="pate" type="radio" class ="radio" value="ni" <?php if ($band =='ni') echo 'checked';?>></td>
	<td><center><img src="../img/bandeiras30/nl.png">	<br> <input name="pate" type="radio" class ="radio" value="nl" <?php if ($band =='nl') echo 'checked';?>></td>
	<td><center><img src="../img/bandeiras30/no.png">	<br> <input name="pate" type="radio" class ="radio" value="no" <?php if ($band =='no') echo 'checked';?>></td>
	<td><center><img src="../img/bandeiras30/np.png">	<br> <input name="pate" type="radio" class ="radio" value="np" <?php if ($band =='np') echo 'checked';?>></td>

	<td><center><img src="../img/bandeiras30/nr.png">	<br> <input name="pate" type="radio" class ="radio" value="nr" <?php if ($band =='nr') echo 'checked';?>></td>
	<td><center><img src="../img/bandeiras30/nz.png">	<br> <input name="pate" type="radio" class ="radio" value="nz" <?php if ($band =='nz') echo 'checked';?>></td>
	<td><center><img src="../img/bandeiras30/om.png">	<br> <input name="pate" type="radio" class ="radio" value="om" <?php if ($band =='om') echo 'checked';?>></td>
	<td><center><img src="../img/bandeiras30/pa.png">	<br> <input name="pate" type="radio" class ="radio" value="pa" <?php if ($band =='pa') echo 'checked';?>></td>
	<td><center><img src="../img/bandeiras30/pe.png">	<br> <input name="pate" type="radio" class ="radio" value="pe" <?php if ($band =='pe') echo 'checked';?>></td>
	<td><center><img src="../img/bandeiras30/pg.png">	<br> <input name="pate" type="radio" class ="radio" value="pg" <?php if ($band =='pg') echo 'checked';?>></td>
	<td><center><img src="../img/bandeiras30/ph.png">	<br> <input name="pate" type="radio" class ="radio" value="ph" <?php if ($band =='ph') echo 'checked';?>></td>
 </tr>

 <tr>
	<td> </td>
 </tr>

 <tr>
	<td><center><img src="../img/bandeiras30/pk.png">	<br> <input name="pate" type="radio" class ="radio" value="pk" <?php if ($band =='pk') echo 'checked';?>></td>
	<td><center><img src="../img/bandeiras30/pl.png">	<br> <input name="pate" type="radio" class ="radio" value="pl" <?php if ($band =='pl') echo 'checked';?>></td>
	<td><center><img src="../img/bandeiras30/pt.png">	<br> <input name="pate" type="radio" class ="radio" value="pt" <?php if ($band =='pt') echo 'checked';?>></td>
	<td><center><img src="../img/bandeiras30/pw.png">	<br> <input name="pate" type="radio" class ="radio" value="pw" <?php if ($band =='pw') echo 'checked';?>></td>
	<td><center><img src="../img/bandeiras30/py.png">	<br> <input name="pate" type="radio" class ="radio" value="py" <?php if ($band =='py') echo 'checked';?>></td>
	<td><center><img src="../img/bandeiras30/qa.png">	<br> <input name="pate" type="radio" class ="radio" value="qa" <?php if ($band =='ga') echo 'checked';?>></td>
	<td><center><img src="../img/bandeiras30/ro.png">	<br> <input name="pate" type="radio" class ="radio" value="ro" <?php if ($band =='ro') echo 'checked';?>></td>

	<td><center><img src="../img/bandeiras30/rs.png">	<br> <input name="pate" type="radio" class ="radio" value="rs" <?php if ($band =='rs') echo 'checked';?>></td>
	<td><center><img src="../img/bandeiras30/ru.png">	<br> <input name="pate" type="radio" class ="radio" value="ru" <?php if ($band =='ru') echo 'checked';?>></td>
	<td><center><img src="../img/bandeiras30/rw.png">	<br> <input name="pate" type="radio" class ="radio" value="rw" <?php if ($band =='rw') echo 'checked';?>></td>
	<td><center><img src="../img/bandeiras30/sa.png">	<br> <input name="pate" type="radio" class ="radio" value="sa" <?php if ($band =='sa') echo 'checked';?>></td>
	<td><center><img src="../img/bandeiras30/sb.png">	<br> <input name="pate" type="radio" class ="radio" value="sb" <?php if ($band =='sb') echo 'checked';?>></td>
	<td><center><img src="../img/bandeiras30/sc.png">	<br> <input name="pate" type="radio" class ="radio" value="sc" <?php if ($band =='sc') echo 'checked';?>></td>
	<td><center><img src="../img/bandeiras30/sd.png">	<br> <input name="pate" type="radio" class ="radio" value="sd" <?php if ($band =='sd') echo 'checked';?>></td>
 </tr>

 <tr>
	<td> </td>
 </tr>

 <tr>
	<td><center><img src="../img/bandeiras30/se.png">	<br> <input name="pate" type="radio" class ="radio" value="se" <?php if ($band =='se') echo 'checked';?>></td>
	<td><center><img src="../img/bandeiras30/sg.png">	<br> <input name="pate" type="radio" class ="radio" value="sg" <?php if ($band =='sg') echo 'checked';?>></td>
	<td><center><img src="../img/bandeiras30/si.png">	<br> <input name="pate" type="radio" class ="radio" value="si" <?php if ($band =='si') echo 'checked';?>></td>
	<td><center><img src="../img/bandeiras30/sk.png">	<br> <input name="pate" type="radio" class ="radio" value="sk" <?php if ($band =='sk') echo 'checked';?>></td>
	<td><center><img src="../img/bandeiras30/sl.png">	<br> <input name="pate" type="radio" class ="radio" value="sl" <?php if ($band =='sl') echo 'checked';?>></td>
	<td><center><img src="../img/bandeiras30/sm.png">	<br> <input name="pate" type="radio" class ="radio" value="sm" <?php if ($band =='sm') echo 'checked';?>></td>
	<td><center><img src="../img/bandeiras30/sn.png">	<br> <input name="pate" type="radio" class ="radio" value="sn" <?php if ($band =='sn') echo 'checked';?>></td>

	<td><center><img src="../img/bandeiras30/so.png">	<br> <input name="pate" type="radio" class ="radio" value="so" <?php if ($band =='so') echo 'checked';?>></td>
	<td><center><img src="../img/bandeiras30/sr.png">	<br> <input name="pate" type="radio" class ="radio" value="sr" <?php if ($band =='sr') echo 'checked';?>></td>
	<td><center><img src="../img/bandeiras30/st.png">	<br> <input name="pate" type="radio" class ="radio" value="st" <?php if ($band =='st') echo 'checked';?>></td>
	<td><center><img src="../img/bandeiras30/sv.png">	<br> <input name="pate" type="radio" class ="radio" value="sv" <?php if ($band =='sv') echo 'checked';?>></td>
	<td><center><img src="../img/bandeiras30/sy.png">	<br> <input name="pate" type="radio" class ="radio" value="sy" <?php if ($band =='sy') echo 'checked';?>></td>
	<td><center><img src="../img/bandeiras30/sz.png">	<br> <input name="pate" type="radio" class ="radio" value="sz" <?php if ($band =='sz') echo 'checked';?>></td>
	<td><center><img src="../img/bandeiras30/td.png">	<br> <input name="pate" type="radio" class ="radio" value="td" <?php if ($band =='td') echo 'checked';?>></td>
 </tr>

 <tr>
	<td> </td>
 </tr>

 <tr>
	<td><center><img src="../img/bandeiras30/tg.png">	<br> <input name="pate" type="radio" class ="radio" value="tg" <?php if ($band =='tg') echo 'checked';?>></td>
	<td><center><img src="../img/bandeiras30/th.png">	<br> <input name="pate" type="radio" class ="radio" value="th" <?php if ($band =='th') echo 'checked';?>></td>
	<td><center><img src="../img/bandeiras30/tj.png">	<br> <input name="pate" type="radio" class ="radio" value="tj" <?php if ($band =='tj') echo 'checked';?>></td>
	<td><center><img src="../img/bandeiras30/tl.png">	<br> <input name="pate" type="radio" class ="radio" value="tl" <?php if ($band =='tl') echo 'checked';?>></td>
	<td><center><img src="../img/bandeiras30/tm.png">	<br> <input name="pate" type="radio" class ="radio" value="tm" <?php if ($band =='tm') echo 'checked';?>></td>
	<td><center><img src="../img/bandeiras30/tn.png">	<br> <input name="pate" type="radio" class ="radio" value="tn" <?php if ($band =='tn') echo 'checked';?>></td>
	<td><center><img src="../img/bandeiras30/to.png">	<br> <input name="pate" type="radio" class ="radio" value="to" <?php if ($band =='to') echo 'checked';?>></td>

	<td><center><img src="../img/bandeiras30/tr.png">	<br> <input name="pate" type="radio" class ="radio" value="tr" <?php if ($band =='tr') echo 'checked';?>></td>
	<td><center><img src="../img/bandeiras30/tt.png">	<br> <input name="pate" type="radio" class ="radio" value="tt" <?php if ($band =='tt') echo 'checked';?>></td>
	<td><center><img src="../img/bandeiras30/tv.png">	<br> <input name="pate" type="radio" class ="radio" value="tv" <?php if ($band =='tv') echo 'checked';?>></td>
	<td><center><img src="../img/bandeiras30/tw.png">	<br> <input name="pate" type="radio" class ="radio" value="tw" <?php if ($band =='tw') echo 'checked';?>></td>
	<td><center><img src="../img/bandeiras30/tz.png">	<br> <input name="pate" type="radio" class ="radio" value="tz" <?php if ($band =='tz') echo 'checked';?>></td>
	<td><center><img src="../img/bandeiras30/ua.png">	<br> <input name="pate" type="radio" class ="radio" value="ua" <?php if ($band =='ua') echo 'checked';?>></td>
	<td><center><img src="../img/bandeiras30/ug.png">	<br> <input name="pate" type="radio" class ="radio" value="ug" <?php if ($band =='ug') echo 'checked';?>></td>
 </tr>

 <tr>
	<td> </td>
 </tr>

 <tr>
	<td><center><img src="../img/bandeiras30/us.png">	<br> <input name="pate" type="radio" class ="radio" value="us" <?php if ($band =='us') echo 'checked';?>></td>
	<td><center><img src="../img/bandeiras30/uy.png">	<br> <input name="pate" type="radio" class ="radio" value="uy" <?php if ($band =='uy') echo 'checked';?>></td>
	<td><center><img src="../img/bandeiras30/uz.png">	<br> <input name="pate" type="radio" class ="radio" value="uz" <?php if ($band =='uz') echo 'checked';?>></td>
	<td><center><img src="../img/bandeiras30/va.png">	<br> <input name="pate" type="radio" class ="radio" value="va" <?php if ($band =='va') echo 'checked';?>></td>
	<td><center><img src="../img/bandeiras30/vc.png">	<br> <input name="pate" type="radio" class ="radio" value="vc" <?php if ($band =='vc') echo 'checked';?>></td>
	<td><center><img src="../img/bandeiras30/ve.png">	<br> <input name="pate" type="radio" class ="radio" value="ve" <?php if ($band =='ve') echo 'checked';?>></td>
	<td><center><img src="../img/bandeiras30/vn.png">	<br> <input name="pate" type="radio" class ="radio" value="vn" <?php if ($band =='vn') echo 'checked';?>></td>

	<td><center><img src="../img/bandeiras30/vu.png">	<br> <input name="pate" type="radio" class ="radio" value="vu" <?php if ($band =='vu') echo 'checked';?>></td>
	<td><center><img src="../img/bandeiras30/ws.png">	<br> <input name="pate" type="radio" class ="radio" value="ws" <?php if ($band =='ws') echo 'checked';?>></td>
	<td><center><img src="../img/bandeiras30/ye.png">	<br> <input name="pate" type="radio" class ="radio" value="ye" <?php if ($band =='ye') echo 'checked';?>></td>
	<td><center><img src="../img/bandeiras30/za.png">	<br> <input name="pate" type="radio" class ="radio" value="za" <?php if ($band =='za') echo 'checked';?>></td>
	<td><center><img src="../img/bandeiras30/zm.png">	<br> <input name="pate" type="radio" class ="radio" value="zm" <?php if ($band =='zm') echo 'checked';?>></td>
	<td><center><img src="../img/bandeiras30/zw.png">	<br> <input name="pate" type="radio" class ="radio" value="zw" <?php if ($band =='zw') echo 'checked';?>></td>
	<td><center><img src="../img/bandeiras30/00.png">	<br> <input name="pate" type="radio" class ="radio" value="" <?php if ($band =='') echo 'checked';?>></td>
 </tr>

 <tr>
  <td colspan=14><br><br><center>  <input type='submit' value='Salvar' class=imput></td>
 </tr>

</table></form>


</div>