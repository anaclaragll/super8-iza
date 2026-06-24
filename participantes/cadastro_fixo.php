<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro Duplas Fixas - Super 8</title>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>
    <div class="container">
        <header class="main-header">
            <h1>Montagem de Duplas</h1>
            <h2>Defina os 8 jogadores em seus times fixos</h2>
        </header>

        <form action="salvar_fixo.php" method="POST">
            <?php for($i=1; $i<=4; $i++): ?>
            <div class="jogador-input" style="border-left: 4px solid var(--accent);">
                <h3 style="color: var(--accent); margin-bottom: 10px;">Dupla <?= $i ?></h3>
                <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 15px;">
                    <div>
                        <label>Jogador A</label>
                        <input type="text" name="duplas[<?= $i ?>][0][nome]" placeholder="Nome Completo" required>
                        <input type="text" name="duplas[<?= $i ?>][0][apelido]" placeholder="Apelido (Opcional)" style="margin-top: 5px; font-size: 0.8rem;">
                    </div>
                    <div>
                        <label>Jogador B</label>
                        <input type="text" name="duplas[<?= $i ?>][1][nome]" placeholder="Nome Completo" required>
                        <input type="text" name="duplas[<?= $i ?>][1][apelido]" placeholder="Apelido (Opcional)" style="margin-top: 5px; font-size: 0.8rem;">
                    </div>
                </div>
            </div>
            <?php endfor; ?>

            <button type="submit" style="width: 100%; margin-top: 10px;">Gravar Duplas e Gerar Tabela</button>
        </form>
    </div>
</body>
</html>