<?php
// Arquivo: bin/migrate.php
// Digite para executar: php bin/migrate.php

echo "Iniciando sistema de Migrations do Eversidian...\n";
echo "------------------------------------------------\n";

// 1. Configurações de Conexão (Ajuste para o seu ambiente local)
$host = '127.0.0.1';
$dbname = 'eversidian'; // Nome do seu banco de dados
$user = 'root';         // Seu usuário do MySQL
$pass = '';             // Sua senha do MySQL

try {
    // Conecta ao banco usando PDO
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // 2. Cria a tabela de controle de migrations (se ela ainda não existir)
    $pdo->exec("CREATE TABLE IF NOT EXISTS migrations (
        id INT AUTO_INCREMENT PRIMARY KEY,
        arquivo VARCHAR(255) UNIQUE NOT NULL,
        executado_em TIMESTAMP DEFAULT CURRENT_TIMESTAMP
    )");

    // 3. Busca quais migrations já foram executadas no passado
    $stmt = $pdo->query("SELECT arquivo FROM migrations");
    $migrationsRodadas = $stmt->fetchAll(PDO::FETCH_COLUMN);

    // 4. Mapeia todos os arquivos .sql na pasta Database/migrations/
    $caminhoPasta = __DIR__ . '/../Database/migrations/';
    $arquivosSql = glob($caminhoPasta . '*.sql');

    if (empty($arquivosSql)) {
        echo "Nenhum arquivo .sql encontrado em Database/migrations/.\n";
        exit;
    }

    $algumaExecutada = false;

    // 5. Percorre os arquivos e executa apenas os novos
    foreach ($arquivosSql as $arquivo) {
        $nomeArquivo = basename($arquivo);

        if (!in_array($nomeArquivo, $migrationsRodadas)) {
            echo "Executando: {$nomeArquivo}...\n";
            
            // Lê o conteúdo do arquivo SQL
            $sql = file_get_contents($arquivo);
            
            // Executa o SQL no banco
            $pdo->exec($sql);

            // Registra no banco que essa migration já foi feita
            $stmt = $pdo->prepare("INSERT INTO migrations (arquivo) VALUES (?)");
            $stmt->execute([$nomeArquivo]);
            
            echo " -> [SUCESSO]\n";
            $algumaExecutada = true;
        }
    }

    if (!$algumaExecutada) {
        echo "Nada a fazer. O banco de dados já está totalmente atualizado!\n";
    } else {
        echo "------------------------------------------------\n";
        echo "Todas as novas migrations foram aplicadas!\n";
    }

} catch (PDOException $e) {
    echo " -> [ERRO FATAL] Falha no banco de dados: " . $e->getMessage() . "\n";
    exit(1);
}