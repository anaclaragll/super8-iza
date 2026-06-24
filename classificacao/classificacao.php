<?php
require_once '../utils/json_helper.php';
require_once '../utils/pontuacao.php';

// Carrega os dados atualizados dos arquivos JSON
$dados_torneio = ler_json('../data/rodadas.json');
$participantes = ler_json('../data/participantes.json');

// Calcula o ranking ordenado com base nas regras de negócio e critérios de desempate
$ranking = calcular_classificacao($dados_torneio, $participantes);
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Classificação Geral - Super 8</title>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>
    <div class="container">
        <header style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px;">
            <h1>📊 Tabela de Classificação</h1>
            <a href="../rodadas/rodadas.php" class="btn">⬅️ Voltar para as Rodadas</a>
        </header>

        <div class="table-container">
            <table>
                <thead>
                    <tr>
                        <th>Pos</th>
                        <th class="text-left">Jogador</th>
                        <th>PJ</th>
                        <th>V</th>
                        <th>E</th>
                        <th>D</th>
                        <th>GF</th>
                        <th>GC</th>
                        <th>SG</th>
                        <th style="background-color: #d4edda; color: var(--text-dark);">Pts</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($ranking as $index => $j): ?>
                        <tr>
                            <td class="fw-bold"><?= $index + 1 ?>º</td>
                            <td class="text-left">
                                <?= htmlspecialchars($j['nome']) ?> 
                                <?= !empty($j['apelido']) ? "({$j['apelido']})" : "" ?>
                            </td>
                            <td><?= $j['jogos'] ?></td>
                            <td><?= $j['vitorias'] ?></td>
                            <td><?= $j['empates'] ?></td>
                            <td><?= $j['derrotas'] ?></td>
                            <td><?= $j['games_favor'] ?></td>
                            <td><?= $j['games_contra'] ?></td>
                            <td class="fw-bold" style="color: <?= $j['saldo_games'] >= 0 ? 'var(--success)' : 'var(--danger)' ?>;">
                                <?= $j['saldo_games'] > 0 ? '+'.$j['saldo_games'] : $j['saldo_games'] ?>
                            </td>
                            <td class="fw-bold" style="background-color: #e8f5e9; color: var(--success);"><?= $j['pontos'] ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
        
        <div style="margin-top: 30px; font-size: 0.85rem; color: var(--text-muted);">
            <p><strong>Legenda:</strong> Pos: Posição · PJ: Partidas Jogadas · V: Vitórias · E: Empates · D: Derrotas · GF: Games a Favor · GC: Games Contra · SG: Saldo de Games · Pts: Pontuação Geral</p>
        </div>
    </div>
</body>
</html>