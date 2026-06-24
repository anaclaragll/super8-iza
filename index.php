<?php
require_once 'utils/json_helper.php';
$tem_rodadas = file_exists('data/rodadas.json');
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Super 8 - Beach Tennis</title>
    <link rel="stylesheet" href="css/style.css?v=3.0">
</head>
<body>
    <div class="container dashboard-container">
        <header class="main-header">
            <div class="brand-info">
                <span class="badge-live">Live</span>
                <h1>Torneio Super 8</h1>
                <h2>Plataforma de Gestão de Confrontos</h2>
            </div>
        </header>
        
        <div class="dashboard-grid">
            <a href="configuracao/formato.php" class="dash-card action-new">
                <div class="card-icon">＋</div>
                <div class="card-content">
                    <h3>Novo Torneio</h3>
                    <p>Defina o formato e inicie uma nova competição.</p>
                </div>
            </a>
            
            <?php if ($tem_rodadas): ?>
                <a href="rodadas/rodadas.php" class="dash-card action-primary">
                    <div class="card-icon">⚡</div>
                    <div class="card-content">
                        <h3>Painel de Quadras</h3>
                        <p>Gerenciar partidas ativas e lançar placares.</p>
                    </div>
                </a>
                <a href="classificacao/classificacao.php" class="dash-card action-success">
                    <div class="card-icon">📊</div>
                    <div class="card-content">
                        <h3>Classificação Geral</h3>
                        <p>Estatísticas e saldo de games em tempo real.</p>
                    </div>
                </a>
            <?php endif; ?>
        </div>
    </div>
</body>
</html>