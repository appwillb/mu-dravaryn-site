<!DOCTYPE html>
<html>
<head>
    <meta http-equiv='Content-Type' content='text/html;charset=UTF-8'>
    <link rel="stylesheet" href="css/paginas.css" type="text/css" media="screen" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Cinzel:wght@600;700&family=Montserrat:wght@400;600&display=swap" rel="stylesheet">
    <script type="text/javascript" src="js/jquery.min.js"></script>
    <style>
        body { font-family: 'Montserrat', sans-serif; background: transparent; color: #d0d7de; }
        h3, h4 { font-family: 'Cinzel', serif; color: #ffd700; letter-spacing: 1px; }
        .info-card {
            background: rgba(15, 20, 30, 0.9);
            border: 1px solid rgba(0, 180, 255, 0.25);
            border-radius: 10px;
            padding: 20px;
            margin-bottom: 25px;
            box-shadow: 0 4px 20px rgba(0,0,0,0.6);
        }
        .table-custom { width: 100%; border-collapse: separate; border-spacing: 0 8px; }
        .table-custom td { padding: 10px 15px; background: rgba(25, 32, 48, 0.6); border-top: 1px solid rgba(255,255,255,0.05); }
        .table-custom td.label-col { font-weight: bold; color: #00b4ff; width: 40%; }
        .badge-gold { background: #d4af37; color: #111; font-weight: bold; padding: 4px 8px; border-radius: 4px; }
    </style>
    <script type="text/javascript">
        function tamanho(){
            $("#main2", window.parent.document).height($("#tamanho").height() + 80);
        }
    </script>
</head>
<body onload="tamanho()">
<div id="tamanho" style="padding: 20px 40px;">
    <center>
        <h3>INFORMAÇÕES OFICIAIS DO SERVIDOR</h3>
        <p style="color: #8b949e;">Configuração 100% balanceada e baseada nos padrões do MU Vanguard</p>
    </center>

    <div class="info-card">
        <h4><i class="glyphicon glyphicon-flash"></i> Visão Geral & Economia</h4>
        <table class="table-custom">
            <tr><td class="label-col">Versão</td><td>Season 6 Episódio 3 (Original)</td></tr>
            <tr><td class="label-col">Experiência Normal (EXP)</td><td><span class="badge-gold">50x</span></td></tr>
            <tr><td class="label-col">Master Experience (ML)</td><td><span class="badge-gold">30x</span></td></tr>
            <tr><td class="label-col">Taxa de Drop Geral</td><td>20%</td></tr>
            <tr><td class="label-col">Level Máximo</td><td>400 (Base) + 200 (Master Level)</td></tr>
            <tr><td class="label-col">Sistema de Reset</td><td>Level 400 · <b>1.000 pontos</b> por Reset (Pontuativo)</td></tr>
            <tr><td class="label-col">Custo do Reset</td><td>20.000.000 Zen (Free) / 10.000.000 Zen (VIP)</td></tr>
            <tr><td class="label-col">Tamanho Máximo da Party</td><td>5 Jogadores (Bônus de Party ativado)</td></tr>
            <tr><td class="label-col">Spots Mapeados</td><td><b>1.399 spots dedicados</b> (5 monstros por spot em 29 mapas)</td></tr>
        </table>
    </div>

    <div class="info-card">
        <h4><i class="glyphicon glyphicon-time"></i> Cronograma de Invasões & Chefes</h4>
        <table class="table-custom">
            <tr><td class="label-col">Golden Dragon (Dragões Dourados)</td><td>00:00 · 06:00 · 12:00 · 18:00 (A cada 6 horas)</td></tr>
            <tr><td class="label-col">Red Dragon (Dragão Vermelho)</td><td>01:30 · 04:15 · 08:15 · 13:30 · 16:15 · 20:15 (6x ao dia)</td></tr>
            <tr><td class="label-col">Death King (Rei da Morte)</td><td>00:45 · 03:00 · 06:45 · 09:45 · 12:45 · 15:00 · 18:45 · 21:45</td></tr>
            <tr><td class="label-col">White Wizard (Mago Branco & Orcs)</td><td>02:15 · 07:30 · 11:00 · 14:15 · 19:30 · 22:30</td></tr>
            <tr><td class="label-col">Medusa (Boss de Peace)</td><td>05:00 · 17:00 (A cada 12 horas)</td></tr>
            <tr><td class="label-col">White Rabbits (Coelhos Brancos)</td><td>03:45 · 15:45 (A cada 12 horas)</td></tr>
        </table>
    </div>

    <div class="info-card">
        <h4><i class="glyphicon glyphicon-fire"></i> Eventos Diários & Especiais</h4>
        <table class="table-custom">
            <tr><td class="label-col">Blood Castle (1 a 8)</td><td>A cada 2 horas (Início em horas ímpares)</td></tr>
            <tr><td class="label-col">Devil Square (1 a 7)</td><td>A cada 2 horas (Início em horas pares)</td></tr>
            <tr><td class="label-col">Chaos Castle (1 a 7)</td><td>A cada 4 horas</td></tr>
            <tr><td class="label-col">Crywolf & Balgass</td><td>Todos os dias às 21:00</td></tr>
            <tr><td class="label-col">Castle Siege</td><td>Todo Domingo às 16:00</td></tr>
        </table>
    </div>
</div>
</body>
</html>
