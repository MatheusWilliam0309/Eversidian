<?php
    // =========================================================================
    // 1. INÍCIO DO OUTPUT BUFFERING (Filtro Mágico de Rotas)
    // =========================================================================
    // O PHP vai segurar todo o HTML e não enviará nada ao navegador até o final.
    ob_start();

    // Exibe erros na tela (Recomendado para ambiente de desenvolvimento local)
    ini_set('display_errors', 1);
    error_reporting(E_ALL);

    // Inicializa o sistema de sessões
    require_once __DIR__ . '/app/Core/Session.php';
    Session::start();

    // =========================================================================
    // 2. CAPTURA E LIMPEZA DA URL
    // =========================================================================
    // Pega a URL vinda do .htaccess ou define 'home' como padrão
    $url = isset($_GET['url']) ? rtrim($_GET['url'], '/') : 'home';
    $url = filter_var($url, FILTER_SANITIZE_URL);

    // Quebra a URL em pedaços para saber qual Controller e Método chamar
    // Ex: "loja/carrinho" vira $rotas[0] = 'loja', $rotas[1] = 'carrinho'
    $rotas = explode('/', $url);
    $pagina = strtolower($rotas[0]);
    $acao = isset($rotas[1]) ? strtolower($rotas[1]) : 'index';

    // =========================================================================
    // 3. ROTEADOR CENTRAL (FRONT CONTROLLER)
    // =========================================================================
    switch ($pagina) {
        
        // --- PÁGINAS PÚBLICAS E AUTENTICAÇÃO ---
        case 'home':
        case '':
            require_once __DIR__ . '/app/View/Home/index.php';
            break;

        case 'login':
            require_once __DIR__ . '/app/View/Auth/login.php';
            break;

        case 'cadastro':
            require_once __DIR__ . '/app/View/Auth/cadastro.php';
            break;

        case 'login-processar':
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                require_once __DIR__ . '/app/Controller/AuthController.php';
                $auth = new AuthController();
                $auth->postLogin($_POST['email'], $_POST['senha']);
            }
            break;

        case 'logout':
            require_once __DIR__ . '/app/Controller/AuthController.php';
            $auth = new AuthController();
            $auth->logout();
            break;

        // --- MÓDULO: CAMPANHAS ---
        case 'campanhas':
            require_once __DIR__ . '/app/Controller/CampanhaController.php';
            $campanhaController = new CampanhaController();
            
            if ($acao === 'nova') {
                // Em breve criaremos a View de nova campanha
                echo "<h1>Tela de Criar Nova Campanha</h1>";
            } elseif ($acao === 'jogar') {
                // Tela de gameplay com chat e dados
                echo "<h1>Mesa Virtual (Em construção)</h1>";
            } else {
                // Lista as campanhas (View gerada na Etapa 4)
                // Em um sistema final, você chamaria $campanhaController->index();
                // Aqui vamos chamar a View diretamente para testes visuais:
                require_once __DIR__ . '/app/View/Campanha/index.php';
            }
            break;

        // --- MÓDULO: CRÔNICAS ---
        case 'cronicas':
            require_once __DIR__ . '/app/Controller/CronicaController.php';
            $cronicaController = new CronicaController();
            
            if ($acao === 'ler') {
                $id = isset($_GET['id']) ? (int)$_GET['id'] : 0;
                // $cronicaController->ler($id);
                echo "<h1>Lendo Pergaminho {$id}</h1>";
            } else {
                // Lista todas as crônicas
                $cronicaController->index();
            }
            break;

        // --- MÓDULO: LOJA VIRTUAL ---
        case 'loja':
            require_once __DIR__ . '/app/Controller/LojaController.php';
            $lojaController = new LojaController();
            
            if ($acao === 'carrinho') {
                // Exibe a bolsa de itens
                require_once __DIR__ . '/app/View/Loja/carrinho.php';
            } elseif ($acao === 'adicionar' && $_SERVER['REQUEST_METHOD'] === 'POST') {
                // Lógica de adicionar ao carrinho
                echo "Lógica de adicionar: Item " . $_POST['id_produto'];
            } elseif ($acao === 'remover' && $_SERVER['REQUEST_METHOD'] === 'POST') {
                // Lógica de descarte
                echo "Lógica de remover: Item " . $_POST['id_item'];
            } elseif ($acao === 'checkout' && $_SERVER['REQUEST_METHOD'] === 'POST') {
                // Lógica de finalização
                echo "Lógica de checkout iniciada.";
            } else {
                // Vitrine principal (Controller busca os dados e inclui a View)
                $lojaController->index();
            }
            break;

        // --- ROTA NÃO ENCONTRADA (404) ---
        default:
            http_response_code(404);
            echo "<div style='background:#131313; height:100vh; display:flex; align-items:center; justify-content:center; flex-direction:column; color:#e5e2e1; font-family:sans-serif;'>";
            echo "<h1 style='color:#f95e14; font-size:3rem; margin-bottom:10px;'>Erro 404</h1>";
            echo "<p style='color:#d6c692; font-style:italic;'>Este plano místico não existe no Vácuo.</p>";
            echo "<a href='/' style='color:#f95e14; margin-top:20px;'>Retornar ao mundo conhecido</a>";
            echo "</div>";
            break;
    }

    // =========================================================================
    // 4. APLICAÇÃO DO FILTRO (Magia de Rotas) E SAÍDA
    // =========================================================================

    // Captura todo o HTML (Views) gerado pelo sistema até agora e limpa o buffer
    $html = ob_get_clean();

    // Descobre o nome da pasta base onde o sistema está rodando (Ex: "/Eversidian")
    $pastaBase = str_replace('\\', '/', dirname($_SERVER['SCRIPT_NAME']));
    $pastaBase = rtrim($pastaBase, '/');

    // Se o sistema NÃO estiver na raiz absoluta do servidor, aplica o filtro
    if ($pastaBase !== '') {
        /* * Expressão Regular (Regex): 
        * Procura por: href="/ ou src="/ ou action="/ (ignorando se for // do tipo https://)
        * Substitui por: href="/Eversidian/ ou src="/Eversidian/
        * Isso mantém o seu código das Views 100% limpo!
        */
        $html = preg_replace('/(href|src|action)=["\']\/(?![\/])/', '$1="' . $pastaBase . '/', $html);
    }

    // Envia o HTML final com as rotas corrigidas magicamente para o navegador
    echo $html;
?>