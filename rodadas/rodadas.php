<?php
require_once '../utils/json_helper.php';

// 1. Carrega os dados dos arquivos JSON
$dados_torneio = ler_json('../data/rodadas.json');
$participantes = ler_json('../data/participantes.json');

// Mapeia os participantes por ID para ficar fácil buscar o nome deles pelo ID numérico
$jogadores_indexados = [];
foreach ($participantes as $p) {
    $jogadores_indexados[$p['id']] = !empty($p['apelido']) ? $p['apelido'] : $p['nome'];
}

// 2. Encontra qual rodada precisa ser jogada/preenchida no momento
$rodada_atual = null;
foreach ($dados_torneio['rodadas'] as $r) {
    if (!$r['concluida']) {
        $rodada_atual = $r;
        break;
    }
}

// Se não encontrou nenhuma rodada pendente, o torneio acabou!
if ($rodada_atual === null) {
    echo "<div class='container'>";
    echo "<h2>🏆 Fim do Torneio! Todas as rodadas foram concluídas.</h2>";
    echo "<p><a href='../classificacao/classificacao.php'><button>Ver Classificação Final</button></a></p>";
    echo "</div>";
    exit;
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rodadas do Torneio - Super 8</title>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>
    <div class="container">
        <header style="display: flex; justify-content: space-between; align-items: center;">
            <h1>🎾 Em andamento: Rodada <?= $rodada_atual['numero'] ?> de 7</h1>
            <a href="../classificacao/classificacao.php" style="text-decoration: none;">📊 Ver Classificação</a>
        </header>
        
        <hr>

        <form action="salvar_placar.php" method="POST">
            <input type="hidden" name="numero_rodada" value="<?= $rodada_atual['numero'] ?>">

            <?php foreach ($rodada_atual['partidas'] as $index => $partida): ?>
                <div class="card-partida">
                    <h3>Quadra <?= $partida['quadra'] ?></h3>
                    
                    <div class="placar-flex" style="display: flex; align-items: center; justify-content: space-around; margin: 15px 0;">
                        <?php 
                            $chave_1 = isset($partida['dupla_a']) ? 'dupla_a' : 'dupla_c';
                            $chave_2 = isset($partida['dupla_b']) ? 'dupla_b' : 'dupla_d';
                            $placar_1 = isset($partida['dupla_a']) ? 'placar_a' : 'placar_c';
                            $placar_2 = isset($partida['dupla_b']) ? 'placar_b' : 'placar_d';
                        ?>

                        <div class="dupla-nome" style="text-align: right; width: 40%;">
                            <strong>
                                <?= $jogadores_indexados[$partida[$chave_1][0]] ?> + 
                                <?= $jogadores_indexados[$partida[$chave_1][1]] ?>
                            </strong>
                        </div>

                        <div class="inputs-placar" style="display: flex; gap: 10px; align-items: center;">
                            <input type="number" name="partidas[<?= $partida['id_partida'] ?>][<?= $placar_1 ?>]" min="0" max="7" required style="width: 50px; text-align: center; font-size: 1.2rem;">
                            <span>✖</span>
                            <input type="number" name="partidas[<?= $partida['id_partida'] ?>][<?= $placar_2 ?>]" min="0" max="7" required style="width: 50px; text-align: center; font-size: 1.2rem;">
                        </div>

                        <div class="dupla-nome" style="text-align: left; width: 40%;">
                            <strong>
                                <?= $jogadores_indexados[$partida[$chave_2][0]] ?> + 
                                <?= $jogadores_indexados[$partida[$chave_2][1]] ?>
                            </strong>
                        </div>
                    </div>
                </div>
                <hr>
            <?php endforeach; ?>

            <button type="submit" style="width: 100%; padding: 15px; font-size: 1.1rem; cursor: pointer;">Confirmar Placares da Rodada ✅</button>
        </form>
    </div>
</body>
</html>