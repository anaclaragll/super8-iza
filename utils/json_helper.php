<?php
// Função para ler um arquivo JSON e transformar em Array do PHP
function ler_json($caminho_arquivo) {
    if (!file_exists($caminho_arquivo)) {
        return []; // Se o arquivo não existir, retorna um array vazio
    }
    $conteudo = file_get_contents($caminho_arquivo);
    return json_decode($conteudo, true); // O 'true' transforma em array associativo
}

// Função para transformar um Array PHP em JSON e salvar no arquivo
function gravar_json($caminho_arquivo, $dados) {
    // Cria a pasta 'data' se ela ainda não existir
    $diretorio = dirname($caminho_arquivo);
    if (!is_dir($diretorio)) {
        mkdir($diretorio, 0777, true);
    }
    
    // JSON_PRETTY_PRINT deixa o arquivo JSON organizado e legível para humanos
    $conteudo_json = json_encode($dados, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
    return file_put_contents($caminho_arquivo, $conteudo_json);
}