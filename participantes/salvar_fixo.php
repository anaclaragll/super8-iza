<?php
require_once '../utils/json_helper.php';
require_once '../utils/sorteio.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $duplas_post = $_POST['duplas'];
    $participantes = [];
    $id_cont = 1;

    // Organiza os participantes para o JSON
    foreach ($duplas_post as $dupla) {
        foreach ($dupla as $jogador) {
            $participantes[] = [
                'id' => $id_cont++,
                'nome' => $jogador['nome'],
                'apelido' => $jogador['apelido']
            ];
        }
    }

    gravar_json('../data/participantes.json', $participantes);

    // Gera as rodadas para duplas fixas (usando a lógica que já temos no sorteio.php)
    $rodadas_geradas = gerar_rodadas_fixas();
    $dados_torneio = [
        "formato" => "fixas",
        "rodadas" => $rodadas_geradas
    ];

    gravar_json('../data/rodadas.json', $dados_torneio);

    header('Location: ../rodadas/rodadas.php');
    exit;
}