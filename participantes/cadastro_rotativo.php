<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inscrição de Atletas - Super 8</title>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>
    <div class="container">
        <header class="main-header">
            <h1>Inscrição de Atletas</h1>
            <h2>Insira os 8 jogadores do torneio rotativo</h2>
        </header>

        <form action="salvar_rotativo.php" method="POST">
            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 15px;">
                <?php for ($i = 1; $i <= 8; $i++): ?>
                <div class="jogador-input">
                    <label>Jogador <?= $i ?></label>
                    <input type="text" name="jogadores[<?= $i ?>][nome]" placeholder="Nome Completo" required>
                    <input type="text" name="jogadores[<?= $i ?>][apelido]" placeholder="Apelido (Opcional)" style="margin-top: 5px; font-size: 0.8rem;">
                </div>
                <?php endfor; ?>
            </div>

            <button type="submit" style="width: 100%; margin-top: 20px;">Gravar e Gerar Confrontos</button>
        </form>
    </div>
</body>
</html>