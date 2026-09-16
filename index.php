<?php
// =========================================================================
// 1. INÍCIO DO OUTPUT BUFFERING E CONFIGURAÇÕES CORE
// =========================================================================
ob_start();

ini_set('display_errors', 1);
error_reporting(E_ALL);

require_once __DIR__ . '/app/Core/Session.php';
Session::start();

// Define o diretório base para os redirecionamentos (Headers)
$pastaBase = rtrim(str_replace('\\', '/', dirname($_SERVER['SCRIPT_NAME'])), '/');
define('BASE_DIR', '/' . trim($pastaBase, '/'));

// =========================================================================
// 2. INVOCAÇÃO DO ROTEADOR
// =========================================================================
// Delegamos o destino do aventureiro ao ficheiro de rotas
require_once __DIR__ . '/Routes/Web.php';

// =========================================================================
// 3. APLICAÇÃO DO FILTRO MÁGICO CONTRA DUPLICAÇÃO E SAÍDA
// =========================================================================
$html = ob_get_clean();

if ($pastaBase !== '') {
    $pastaBaseClean = trim($pastaBase, '/');
    $html = preg_replace('/(href|src|action)=["\']\/(?!' . preg_quote($pastaBaseClean, '/') . '\/|\/)/', '$1="' . $pastaBase . '/', $html);
}

echo $html;
?>