<?php

// Algoritmo para Duplas Rotativas (Garante o balanço ideal de parceiros para 8 jogadores)
function gerar_rodadas_rotativas() {
    // Matriz matemática perfeita para balanceamento de 8 jogadores em 7 rodadas.
    // Cada linha representa uma rodada. Os números são os IDs dos jogadores (1 a 8).
    // Sempre teremos 2 partidas por rodada (Quadra 1 e Quadra 2)
    $esquema = [
        1 => [ 'q1_a' => [1, 2], 'q1_b' => [3, 4], 'q2_c' => [5, 6], 'q2_d' => [7, 8] ],
        2 => [ 'q1_a' => [1, 3], 'q1_b' => [2, 5], 'q2_c' => [4, 7], 'q2_d' => [6, 8] ],
        3 => [ 'q1_a' => [1, 4], 'q1_b' => [2, 7], 'q2_c' => [3, 6], 'q2_d' => [5, 8] ],
        4 => [ 'q1_a' => [1, 5], 'q1_b' => [2, 4], 'q2_c' => [3, 8], 'q2_d' => [6, 7] ],
        5 => [ 'q1_a' => [1, 6], 'q1_b' => [2, 8], 'q2_c' => [3, 5], 'q2_d' => [4, 7] ],
        6 => [ 'q1_a' => [1, 7], 'q1_b' => [3, 4], 'q2_c' => [2, 6], 'q2_d' => [5, 8] ],
        7 => [ 'q1_a' => [1, 8], 'q1_b' => [2, 3], 'q2_c' => [4, 5], 'q2_d' => [6, 7] ]
    ];

    $rodadas = [];
    foreach ($esquema as $num_rodada => $jogos) {
        $rodadas[] = [
            "numero" => $num_rodada,
            "concluida" => false,
            "partidas" => [
                [
                    "id_partida" => ($num_rodada * 2) - 1,
                    "quadra" => 1,
                    "dupla_a" => $jogos['q1_a'],
                    "dupla_b" => $jogos['q1_b'],
                    "placar_a" => null,
                    "placar_b" => null
                ],
                [
                    "id_partida" => ($num_rodada * 2),
                    "quadra" => 2,
                    "dupla_c" => $jogos['q2_c'],
                    "dupla_d" => $jogos['q2_d'],
                    "placar_c" => null,
                    "placar_d" => null
                ]
            ]
        ];
    }
    return $rodadas;
}

// Algoritmo para Duplas Fixas
function gerar_rodadas_fixas() {
    // 8 jogadores formam 4 duplas fixas estáticas
    $duplas = [
        1 => [1, 2],
        2 => [3, 4],
        3 => [5, 6],
        4 => [7, 8]
    ];

    // Confrontos base para 4 equipes (Round Robin de 3 rodadas)
    $confrontos_base = [
        1 => [ ['a' => 1, 'b' => 4], ['c' => 2, 'd' => 3] ],
        2 => [ ['a' => 1, 'b' => 3], ['c' => 4, 'd' => 2] ],
        3 => [ ['a' => 1, 'b' => 2], ['c' => 3, 'd' => 4] ]
    ];

    $rodadas = [];
    $id_partida = 1;

    for ($r = 1; $r <= 7; $r++) {
        $indice_base = (($r - 1) % 3) + 1;
        $jogos_da_vez = $confrontos_base[$indice_base];

        $rodadas[] = [
            "numero" => $r,
            "concluida" => false,
            "partidas" => [
                [
                    "id_partida" => $id_partida++,
                    "quadra" => 1,
                    "dupla_a" => $duplas[$jogos_da_vez[0]['a']],
                    "dupla_b" => $duplas[$jogos_da_vez[0]['b']],
                    "placar_a" => null,
                    "placar_b" => null
                ],
                [
                    "id_partida" => $id_partida++,
                    "quadra" => 2,
                    "dupla_c" => $duplas[$jogos_da_vez[1]['c']],
                    "dupla_d" => $duplas[$jogos_da_vez[1]['d']],
                    "placar_c" => null,
                    "placar_d" => null
                ]
            ]
        ];
    }
    return $rodadas;
}