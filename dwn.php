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
        .download-box {
            background: rgba(15, 20, 30, 0.9);
            border: 1px solid rgba(0, 180, 255, 0.25);
            border-radius: 10px;
            padding: 25px;
            margin-bottom: 25px;
            box-shadow: 0 4px 20px rgba(0,0,0,0.6);
            text-align: center;
        }
        .btn-download {
            background: linear-gradient(135deg, #0088cc 0%, #005588 100%);
            border: 1px solid #33bbff;
            color: #fff;
            font-family: 'Cinzel', serif;
            font-size: 18px;
            font-weight: bold;
            padding: 12px 30px;
            border-radius: 8px;
            display: inline-block;
            margin: 10px;
            text-decoration: none;
            box-shadow: 0 4px 15px rgba(0, 136, 204, 0.4);
            transition: all 0.3s ease;
        }
        .btn-download:hover {
            color: #fff;
            transform: translateY(-2px);
            box-shadow: 0 0 20px rgba(0, 200, 255, 0.7);
        }
        .req-table { width: 100%; border-collapse: separate; border-spacing: 0 6px; }
        .req-table td { padding: 8px 12px; background: rgba(25, 32, 48, 0.6); }
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
        <h3>DOWNLOAD DO CLIENTE OFICIAL</h3>
        <p style="color: #8b949e;">Baixe o cliente completo com instalador automático e sons inclusos</p>
    </center>

    <div class="download-box">
        <h4>Cliente Completo Dravaryn Season 6 (v1.0)</h4>
        <p style="color: #8b949e; margin-bottom: 20px;">Tamanho: ~750 MB · Instalador Completo com Sons, Efeitos e Launcher Auto-Update</p>
        <a href="#" class="btn-download"><i class="glyphicon glyphicon-cloud-download"></i> Download Direto (Alta Velocidade)</a>
        <a href="#" class="btn-download" style="background: linear-gradient(135deg, #d4af37 0%, #aa8822 100%); border-color: #ffd700; color: #111;"><i class="glyphicon glyphicon-hdd"></i> Google Drive / Mega</a>
    </div>

    <div class="download-box" style="text-align: left;">
        <h4><i class="glyphicon glyphicon-cog"></i> Requisitos do Sistema</h4>
        <table class="req-table">
            <tr style="color: #00b4ff; font-weight: bold;"><td>Componente</td><td>Mínimo</td><td>Recomendado</td></tr>
            <tr><td>Sistema Operacional</td><td>Windows 7 / 8 / 10 / 11</td><td>Windows 10 / 11 (64-bit)</td></tr>
            <tr><td>Processador</td><td>Intel / AMD 1.8 GHz</td><td>Intel / AMD 2.5 GHz ou superior</td></tr>
            <tr><td>Memória RAM</td><td>2 GB</td><td>4 GB ou mais</td></tr>
            <tr><td>Placa de Vídeo</td><td>DirectX 9.0c compatível</td><td>Placa Dedicada NVIDIA / AMD / Intel Iris</td></tr>
            <tr><td>Espaço em Disco</td><td>2 GB livres</td><td>5 GB livres em SSD</td></tr>
        </table>
    </div>
</div>
</body>
</html>
