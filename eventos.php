<head>
	<meta http-equiv='Content-Type' content='text/html;charset=UTF-8'>

	<link rel="stylesheet" href="css/paginas.css" type="text/css" media="screen" />

        <script type="text/javascript" src="js/jquery-1.3.2.min.js"></script>

	<script type="text/javascript">
        function tamanho(){
		$("#main2", window.parent.document).height($("#tamanho").height() + 40);
	    }
        </script>

</head>

<body leftmargin= "0" topmargin="0" onload="tamanho()">
<div id="tamanho">
<center>


<BR><BR><font size=3><b>HORÁRIOS DOS EVENTOS</font></b> <BR><BR>

<div class="events" style='height:660px'></div>

<script>
    var eventsTime = [["DROP DE ITENS",["12:00","19:00","23:00"]],["<a href=evento_survivor.php>Survivor</a>",["00:10","01:10","02:10","02:10","03:10","04:10","05:10","06:10","07:10","08:10","09:10","10:10","11:10","12:10","13:10","14:10","15:10","16:10","17:10","18:10","19:10","20:10","21:10","22:10","23:10"]],["Blood Castle",["00:00","02:00","04:00","06:00","08:00","10:00","12:00","14:00","16:00","18:00","20:00","22:00"]],["Chaos Castle",["01:00","03:00","05:00","07:00","09:00","11:00","13:00","15:00","17:00","19:00","21:00","23:00"]],["Devil Square",["00:30","02:30","04:30","06:30","08:30","10:30","12:30","14:30","16:30","18:30","20:30","22:30"]],["Moss Merchant",["02:00","08:00","14:00","20:00"]],["Invasao do Skeleton King",["00:05","04:05","08:05","12:05","16:05","20:05"]],["Invasao do Red Dragon",["00:15","04:15","08:15","12:15","16:15","20:15"]],["Invasao do White Wizard",["00:50","04:50","08:50","12:50","16:50","20:50"]],["<a href=evento_goldens.php>Invasao dos Goldens</a>",["00:25","04:25","08:25","12:25","13:25","14:25","15:25","16:25","17:25","18:25","19:25","20:25","21:25","22:25","23:25"]],["Invasao dos Rabbits",["02:15","06:15","10:15","14:15","18:15","22:15"]],["Invasao dos Demons",["01:25","05:25","09:25","13:25","17:25","21:25"]],["<a href=evento_eggs.php>Invasao dos Eggs</a>",["01:50","05:50","09:50","13:50","17:50","21:50"]],["Medusa",["01:00","05:00","09:00","13:00","17:00","21:00"]],["Crywolf",[4,7],["20:30","20:30"]],["<a href=evento_arena.php>Arena - DMxDM</a>",[7],["17:00"]],["<a href=evento_arena.php>Arena - GMxGM</a>",[7],["17:20"]],["<a href=evento_arena.php>Arena - BMxBM</a>",[7],["17:40"]],["<a href=evento_arena.php>Arena - FMxFM</a>",[7],["18:00"]],["<a href=evento_arena.php>Arena - LExLE</a>",[7],["18:20"]],["<a href=evento_arena.php>Arena - ELFxELF</a>",[7],["18:40"]],["<a href=evento_arena.php>Arena - SUMxSUM</a>",[7],["19:00"]]];

    function toSeconds(h,m,s){
        return h*3600+m*60+s;
    }

    function DateUTC(offset) {
        d = new Date();
        utc = d.getTime() + (d.getTimezoneOffset() * 60000);
        return new Date(utc + (3600000*offset));
    }

    function updateEventsTime()
    {
        var d = DateUTC('-2');
        var time = toSeconds(d.getHours(), d.getMinutes(), d.getSeconds());

        var html = '<table border = 0  width=600 cellspacing=0 align=center>	<thead> 	 <tr>  		<th colspan=2>Lista de eventos</td>	 </tr> 	 <tr>  		<th><center>Nome do evento:</td>  		<th><center>Tempo para iniciar:</td> 	 </tr>	</thead>';
        for (i in eventsTime) {

            line = eventsTime[i];

            if(line.length == 2 && typeof(line[1]) == 'object'){

                var j;
                for (j=0; j<line[1].length; j++) {
                    var t = line[1][j].split(':');
                    t = toSeconds(t[0],t[1],0);
                    if(t > time) break;
                }

                j = j%eventsTime[i][1].length;
                var t = eventsTime[i][1][j].split(':');

                var diff = toSeconds(t[0],t[1],0) - time;
                if(diff < 0) diff += 3600*24;

                var c = "";
                if(diff < 15*60) c = "<font color=red>";

                var h = parseInt(diff/3600);
                diff -= 3600*h;
                var m = parseInt(diff/60);
                var s = diff - m*60;

                var countdown = h+':'+("0" + m).slice(-2)+':'+("0" + s).slice(-2);

                html += '<tr><td style="text-align:left;">'+line[1][j]+' - '+line[0]+'<td><b>'+c+countdown+'</b>';

            }else if(line.length == 3){

                var week = [0,0,0,0,0,0,0];
                var weekH = [0,0,0,0,0,0,0];
                for(j in line[1]){
                    var t = line[2][j].split(':');
                    t = toSeconds(t[0],t[1],0);
                    week[line[1][j]-1] = t;
                    weekH[line[1][j]-1] = line[2][j];
                }

                var dd = d.getDay();
                var total = 0;
                while(1){
                    console.log(week[dd], time);
                    if(week[dd] && ((dd == d.getDay() && week[dd] > time) || dd != d.getDay())){


                        var w = ['Dom','Seg','Ter','Qua','Qui','Sex','Sab'][dd];

                        if(dd == d.getDay()) w = '';


                        var diff = (dd*24*60*60 + week[dd]) - (d.getDay()*24*60*60+time);

                        if(diff < 0) diff += 7*24*60*60;


                        var c = "";
                        if(diff < 60*60) c = "<font color=red>";

                        var days = parseInt(diff/(24*60*60));
                        diff -= days*(24*60*60);
                        var h = parseInt(diff/3600);
                        diff -= 3600*h;
                        var m = parseInt(diff/60);
                        var s = diff - m*60;

                        var count;
                        if(days){
                            count = days+'d '+h+'h';
                        }else{
                            var count = h+':'+("0" + m).slice(-2)+':'+("0" + s).slice(-2);
                        }


                        html += '<tr><td style="text-align:left;">'+w+' '+weekH[dd]+' - '+line[0]+'<td><b>'+c+count+'</b>';

                        break;
                    }

                    if(total++ > 8) {

                        html += '<tr><td style="text-align:left;">'+line[0]+'<td><span class="pull-right label"  style="font-size: 13px;">7d</span>';
                        break;
                    }

                    dd = (dd+1)%7;
                }


            }else{
                html += '<tr><td style="text-align:left;">'+line[0]+'<span class="pull-right label"  style="font-size: 13px;">'+line[1]+'</span>';
            }
        }

	html += '<tr><td style="text-align:left;"><a href=evento_fenix_semanal.php>Caça a Fenix</a><td><b>A todo momento</span><tr><td style="text-align:left;"><a href="https://www.youtube.com/watch?v=AA2l9D6yLtM" target="_blank">Rakilion (Selupan)</a><td><b>A todo momento</span></table>';
        
        $('.events').html(html);
    }

    //onReady.push(function(){ setInterval(updateEventsTime, 1000) });

</script>

<script>
setInterval('updateEventsTime()', 1000);
</script>

</div>