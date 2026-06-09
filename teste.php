<?php
// Mostra todos os erros
ini_set('display_errors', 1);
error_reporting(E_ALL);

// Chama diretamente a Model, ignorando o MVC
require_once __DIR__ . '/app/Model/Usuario.php';

echo "<pre style='background:#111; color:#0f0; padding:20px; font-size: 16px;'>";
echo "=== TESTE DE ISOLAMENTO ABSOLUTO ===\n\n";

$usuarioModel = new Usuario();
$emailTeste = 'teste_' . rand(1000, 9999) . '@eversidian.com';
$senhaTeste = '12345678'; // Palavra-passe estática e limpa

// 1. Gera o Hash
$hashGerado = password_hash($senhaTeste, PASSWORD_ARGON2ID);
echo "1. A forjar o hash puro para '12345678':\n" . $hashGerado . "\n\n";

// 2. Insere na Base de Dados
$inseriu = $usuarioModel->create('Escriba Teste', $emailTeste, $hashGerado);
if ($inseriu) {
    echo "2. Utilizador inserido na base de dados com sucesso.\n\n";
} else {
    die("❌ ERRO FATAL: Falha ao inserir na base de dados. O problema está no INSERT.");
}

// 3. Puxa os dados imediatamente
$utilizadorSalvo = $usuarioModel->findByEmail($emailTeste);
if (!$utilizadorSalvo) {
    die("❌ ERRO FATAL: Não foi possível puxar o utilizador recém-criado. O problema está no SELECT.");
}

echo "3. Hash recuperado do banco:\n" . $utilizadorSalvo['senha'] . "\n\n";

// 4. A Prova Final
echo "4. Resultado da verificação (password_verify):\n";
if (password_verify($senhaTeste, $utilizadorSalvo['senha'])) {
    echo "\n✅ SUCESSO ABSOLUTO! A base de dados e o PHP estão perfeitos.\n\n";
    echo "VEREDITO: O seu ficheiro 'cadastro.php' (HTML) está a enviar a palavra-passe corrompida. Pode haver um campo duplicado com o mesmo 'name', ou o navegador está a injetar espaços no formulário via autofill.";
} else {
    echo "\n❌ FALHA!\n\n";
    echo "VEREDITO: A base de dados está a corromper o texto do hash no momento de guardar. Verifique se o Charset da sua ligação PDO (no Database.php) está configurado para 'utf8mb4'.";
}

echo "</pre>";
?>