<?php
require_once '../utils/json_helper.php';
require_once '../utils/sorteio.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $formato = $_POST['formato'] ?? 'rotativas';

    if ($formato === 'rotativas') {
        $rodadas_geradas = gerar_rodadas_rotativas();
    } else {
        $rodadas_geradas = gerar_rodadas_fixas();
    }

    // Monta a estrutura final do JSON de rodadas
    $dados_torneio = [
        "formato" => $formato,
        "rodadas" => $rodadas_geradas
    ];

    // Salva o arquivo JSON
    gravar_json('../data/rodadas.json', $dados_torneio);

    // Redireciona para a tela que vai exibir as rodadas (que faremos na Etapa 4)
    header('Location: ../rodadas/rodadas.php');
    exit;
} else {
    header('Location: configuracao.php');
    exit;
}