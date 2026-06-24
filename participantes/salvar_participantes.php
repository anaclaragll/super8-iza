<?php
require_once '../utils/json_helper.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $jogadores_enviados = $_POST['jogadores'] ?? [];
    
    // Validação básica: precisamos de exatamente 8 jogadores e os nomes não podem estar vazios
    if (count($jogadores_enviados) !== 8) {
        die("Erro: É necessário cadastrar exatamente 8 jogadores.");
    }
    
    $lista_final = [];
    
    foreach ($jogadores_enviados as $id => $dados) {
        $nome = trim($dados['nome']);
        $apelido = trim($dados['apelido']);
        
        if (empty($nome)) {
            die("Erro: O nome do Jogador $id não pode estar em branco.");
        }
        
        // Monta a estrutura de cada jogador
        $lista_final[] = [
            'id' => (int)$id,
            'nome' => $nome,
            'apelido' => !empty($apelido) ? $apelido : null
        ];
    }
    
    // Caminho onde o JSON será salvo
    $caminho_json = '../data/participantes.json';
    
    // Salva o arquivo
    gravar_json($caminho_json, $lista_final);
    
    // Por enquanto, vamos apenas dar uma mensagem de sucesso. 
    // Depois mudamos o redirecionamento para a tela de escolha de formato!
   // Substitua as linhas de echo por esta:
header('Location: ../configuracao/configuracao.php');
exit;
} else {
    die("Método inválido. Use POST para enviar os dados.");
}