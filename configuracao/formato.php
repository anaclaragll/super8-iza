<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formato do Torneio - Super 8</title>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>
    <div class="container">
        <header class="main-header">
            <h1>Escolha o Formato</h1>
            <h2>Como as duplas serão formadas?</h2>
        </header>

        <div class="dashboard-grid">
            <a href="../participantes/cadastro_rotativo.php" class="dash-card action-primary">
                <div class="card-icon">🔁</div>
                <div class="card-content">
                    <h3>Opção A: Duplas Rotativas</h3>
                    <p>Rei da Quadra. Os parceiros mudam a cada rodada. O sistema sorteia tudo automaticamente.</p>
                </div>
            </a>

            <a href="../participantes/cadastro_fixo.php" class="dash-card action-warning">
                <div class="card-icon">👥</div>
                <div class="card-content">
                    <h3>Opção B: Duplas Fixas</h3>
                    <p>As duplas são definidas manualmente agora e jogam juntas até o fim do torneio.</p>
                </div>
            </a>
        </div>
        
        <div style="margin-top: 20px; text-align: center;">
            <a href="../index.php" style="color: var(--text-muted); text-decoration: none; font-size: 0.9rem;">← Voltar ao Início</a>
        </div>
    </div>
</body>
</html>