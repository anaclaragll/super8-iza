<?php
require_once '../utils/json_helper.php';
require_once '../utils/sorteio.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $jogadores_post = $_POST['jogadores'] ?? [];
    $participantes = [];
    $id_cont = 1;

    // Estrutura os dados para salvar no JSON de participantes
    foreach ($jogadores_post as $jogador) {
        $participantes[] = [
            'id' => $id_cont++,
            'nome' => $jogador['nome'],
            'apelido' => $jogador['apelido']
        ];
    }

    // Salva a lista com os 8 jogadores
    gravar_json('../data/participantes.json', $participantes);

    // Gera automaticamente as rodadas usando o algoritmo correto
    $rodadas_geradas = gerar_rodadas_rotativas();
    
    $dados_torneio = [
        "formato" => "rotativas",
        "rodadas" => $rodadas_geradas
    ];

    // Salva o JSON de confrontos
    gravar_json('../data/rodadas.json', $dados_torneio);

    // Redireciona o usuário direto para o painel de quadras
    header('Location: ../rodadas/rodadas.php');
    exit;
} else {
    header('Location: cadastro_rotativo.php');
    exit;
}