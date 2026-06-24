<?php

function calcular_classificacao($dados_torneio, $participantes) {
    // Inicializa a tabela de classificação para os 8 jogadores
    $ranking = [];
    foreach ($participantes as $p) {
        $ranking[$p['id']] = [
            'id' => $p['id'],
            'nome' => $p['nome'],
            'apelido' => $p['apelido'],
            'jogos' => 0,
            'vitorias' => 0,
            'derrotas' => 0,
            'empates' => 0,
            'games_favor' => 0,
            'games_contra' => 0,
            'saldo_games' => 0,
            'pontos' => 0
        ];
    }

    // Varre todas as rodadas concluídas para acumular os pontos
    foreach ($dados_torneio['rodadas'] as $rodada) {
        if (!$rodada['concluida']) continue; // Pula rodadas que ainda não aconteceram

        foreach ($rodada['partidas'] as $partida) {
            // Identifica as chaves dependendo da estrutura de chaves usadas no JSON
            $chave_1 = isset($partida['dupla_a']) ? 'dupla_a' : 'dupla_c';
            $chave_2 = isset($partida['dupla_b']) ? 'dupla_b' : 'dupla_d';
            $placar_1 = isset($partida['dupla_a']) ? 'placar_a' : 'placar_c';
            $placar_2 = isset($partida['dupla_b']) ? 'placar_b' : 'placar_d';

            $jogadores_1 = $partida[$chave_1]; // Array de IDs da Dupla 1
            $jogadores_2 = $partida[$chave_2]; // Array de IDs da Dupla 2
            $p1 = $partida[$placar_1];
            $p2 = $partida[$placar_2];

            // Se por algum motivo o placar for nulo, ignora
            if ($p1 === null || $p2 === null) continue;

            // Processa dados para os jogadores da Dupla 1
            foreach ($jogadores_1 as $id) {
                $ranking[$id]['jogos']++;
                $ranking[$id]['games_favor'] += $p1;
                $ranking[$id]['games_contra'] += $p2;
                
                if ($p1 > $p2) {
                    $ranking[$id]['vitorias']++;
                    $ranking[$id]['pontos'] += 2;
                } elseif ($p1 < $p2) {
                    $ranking[$id]['derrotas']++;
                } else {
                    $ranking[$id]['empates']++;
                    $ranking[$id]['pontos'] += 1;
                }
            }

            // Processa dados para os jogadores da Dupla 2
            foreach ($jogadores_2 as $id) {
                $ranking[$id]['jogos']++;
                $ranking[$id]['games_favor'] += $p2;
                $ranking[$id]['games_contra'] += $p1;
                
                if ($p2 > $p1) {
                    $ranking[$id]['vitorias']++;
                    $ranking[$id]['pontos'] += 2;
                } elseif ($p2 < $p1) {
                    $ranking[$id]['derrotas']++;
                } else {
                    $ranking[$id]['empates']++;
                    $ranking[$id]['pontos'] += 1;
                }
            }
        }
    }

    // Calcula saldo de games e ordena o ranking
    foreach ($ranking as &$jogador) {
        $jogador['saldo_games'] = $jogador['games_favor'] - $jogador['games_contra'];
    }

    // Algoritmo de ordenação: Primeiro por Pontos, desempate por Saldo de Games, depois por Games a Favor
    usort($ranking, function($a, $b) {
        if ($a['pontos'] !== $b['pontos']) {
            return $b['pontos'] <=> $a['pontos'];
        }
        if ($a['saldo_games'] !== $b['saldo_games']) {
            return $b['saldo_games'] <=> $a['saldo_games'];
        }
        return $b['games_favor'] <=> $a['games_favor'];
    });

    return $ranking;
}