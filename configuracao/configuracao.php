<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Configuração do Torneio - Super 8</title>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>
    <div class="container">
        <h1>⚙️ Configuração do Torneio</h1>
        <h2>Escolha o formato das duplas:</h2>

        <form action="gerar_rodadas.php" method="POST">
            <div class="opcao-formato">
                <input type="radio" id="rotativas" name="formato" value="rotativas" checked>
                <label for="rotativas">
                    <strong>🔁 Opção A — Duplas Rotativas (Rei/Rainha da Quadra)</strong>
                    <p>As duplas mudam a cada rodada. O objetivo é jogar com parceiros diferentes. A pontuação é individual.</p>
                </label>
            </div>

            <div class="opcao-formato" style="margin-top: 20px;">
                <input type="radio" id="fixas" name="formato" value="fixas">
                <label for="fixas">
                    <strong>👥 Opção B — Duplas Fixas</strong>
                    <p>Você definirá 4 duplas fixas no início, e elas jogam juntas até o final do campeonato.</p>
                </label>
            </div>

            <br><br>
            <button type="submit">Gerar as 7 Rodadas 🚀</button>
        </form>
    </div>
</body>
</html>