<?php
require_once '../utils/json_helper.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $numero_rodada = (int)$_POST['numero_rodada'];
    $partidas_enviadas = $_POST['partidas'] ?? [];

    // Carrega o JSON atual
    $dados_torneio = ler_json('../data/rodadas.json');

    // Procura a rodada correta dentro do array e atualiza os valores
    foreach ($dados_torneio['rodadas'] as &$rodada) {
        if ($rodada['numero'] === $numero_rodada) {
            
            // Passa por cada partida gravando os placares
            foreach ($rodada['partidas'] as &$partida) {
                $id_p = $partida['id_partida'];

                if (isset($partidas_enviadas[$id_p])) {
                    if (isset($partida['dupla_a'])) {
                        // Partida da Quadra 1
                        $partida['placar_a'] = (int)$partidas_enviadas[$id_p]['placar_a'];
                        $partida['placar_b'] = (int)$partidas_enviadas[$id_p]['placar_b'];
                    } else {
                        // Partida da Quadra 2
                        $partida['placar_c'] = (int)$partidas_enviadas[$id_p]['placar_c'];
                        $partida['placar_d'] = (int)$partidas_enviadas[$id_p]['placar_d'];
                    }
                }
            }
            
            // Marca a rodada como concluída para que o sistema pule para a próxima
            $rodada['concluida'] = true;
            break;
        }
    }

    // Grava de volta as alterações no arquivo JSON
    gravar_json('../data/rodadas.json', $dados_torneio);

    // Redireciona de volta para a tela de rodadas para carregar a rodada seguinte!
    header('Location: rodadas.php');
    exit;
} else {
    header('Location: rodadas.php');
    exit;
}