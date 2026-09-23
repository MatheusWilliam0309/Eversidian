<?php
// =========================================================================
// ROTEADOR CENTRAL (FRONT CONTROLLER) - Arsenal do Vácuo
// =========================================================================

$url = isset($_GET['url']) ? rtrim($_GET['url'], '/') : 'home';
$url = filter_var($url, FILTER_SANITIZE_URL);

$rotas = explode('/', $url);
$pagina = strtolower($rotas[0]);
$acao = isset($rotas[1]) ? strtolower($rotas[1]) : 'index';

switch ($pagina) {
    
    // --- PÁGINAS PÚBLICAS E AUTENTICAÇÃO ---
    case 'home':
        require_once __DIR__ . '/../app/View/Home/index.php';
    break;

    case 'login':
        require_once __DIR__ . '/../app/View/Auth/login.php';
    break;

    case 'login-processar':
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            require_once __DIR__ . '/../app/Controller/AuthController.php';
            $auth = new AuthController();
            $auth->postLogin($_POST['email'], $_POST['senha']);
        }
    break;

    case 'cadastro':
        require_once __DIR__ . '/../app/View/Auth/cadastro.php';
    break;

    case 'cadastro-processar':
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            require_once __DIR__ . '/../app/Controller/AuthController.php';
            $auth = new AuthController();
            $auth->postCadastro($_POST);
        }
    break;

    case 'logout':
        require_once __DIR__ . '/../app/Controller/AuthController.php';
        $auth = new AuthController();
        $auth->logout();
    break;

    // --- MÓDULO: CAMPANHAS ---
    case 'campanhas':
        require_once __DIR__ . '/../app/Controller/CampanhaController.php';
        $campanhaController = new CampanhaController();
        
        if ($acao === 'nova' && $_SERVER['REQUEST_METHOD'] === 'POST') {
            $campanhaController->store($_POST);
        } elseif ($acao === 'nova') {
            require_once __DIR__ . '/../app/View/Campanha/nova.php';
        } elseif ($acao === 'jogar') {
            echo "<h1>Mesa Virtual (Em construção)</h1>";
        } else {
            $campanhaController->index();
        }
    break;

    // --- MÓDULO: CRÔNICAS ---
    case 'cronicas':
        require_once __DIR__ . '/../app/Controller/CronicaController.php';
        $cronicaController = new CronicaController();
        
        if ($acao === 'ler') {
            $id = isset($_GET['id']) ? (int)$_GET['id'] : 0;
            echo "<h1>Lendo Pergaminho {$id}</h1>";
        } else {
            $cronicaController->index();
        }
    break;

    // --- MÓDULO: LOJA VIRTUAL ---
    case 'loja':
        require_once __DIR__ . '/../app/Controller/LojaController.php';
        $lojaController = new LojaController();
        
        if ($acao === 'carrinho') {
            require_once __DIR__ . '/../app/View/Carrinho/index.php';
        } elseif ($acao === 'produto' && isset($rotas[2])) {
            // A MAGIA NOVA AQUI: Captura o ID da URL (ex: /loja/produto/2)
            $idProduto = (int)$rotas[2];
            $lojaController->verProduto($idProduto);
        } elseif ($acao === 'adicionar' && $_SERVER['REQUEST_METHOD'] === 'POST') {
            $lojaController->adicionarAoCarrinho($_POST);
        } elseif ($acao === 'checkout' && $_SERVER['REQUEST_METHOD'] === 'POST') {
            $lojaController->finalizarCompra($_POST);
        } else {
            $lojaController->index();
        }
    break;

    // --- MÓDULO: PERFIL DO ESCRIBA ---
    case 'perfil':
        require_once __DIR__ . '/../app/Controller/UsuarioController.php';
        $usuarioController = new UsuarioController();
        
        if ($acao === 'atualizar' && $_SERVER['REQUEST_METHOD'] === 'POST') {
            $usuarioController->atualizarDados($_POST);
        } else {
            $usuarioController->index();
        }
    break;

    // --- MÓDULO: ADMINISTRAÇÃO (PAINEL DE MESTRE) ---
    case 'admin':
        require_once __DIR__ . '/../app/Middleware/AdminMiddleware.php';
        AdminMiddleware::check();

        $subModulo = $acao; 
        $subAcao = isset($rotas[2]) ? strtolower($rotas[2]) : 'index';

        if ($subModulo === 'index' || $subModulo === 'dashboard') {
            include_once __DIR__ . '/../app/View/Admin/dashboard.php';
        } elseif ($subModulo === 'produtos') {
            require_once __DIR__ . '/../app/Controller/Admin/AdminProdutoController.php';
            $controller = new AdminProdutoController();
            
            if ($subAcao === 'novo' && $_SERVER['REQUEST_METHOD'] === 'POST') {
                $controller->store($_POST);
            } else {
                $controller->index();
            }
        } elseif ($subModulo === 'usuarios') {
            require_once __DIR__ . '/../app/Controller/Admin/AdminUsuarioController.php';
            $controller = new AdminUsuarioController();
            
            if ($subAcao === 'banir' && $_SERVER['REQUEST_METHOD'] === 'POST') {
                $controller->banir($_POST);
            } elseif ($subAcao === 'revogar' && $_SERVER['REQUEST_METHOD'] === 'POST') {
                $controller->revogarBan($_POST);
            } elseif ($subAcao === 'excluir' && $_SERVER['REQUEST_METHOD'] === 'POST') {
                $controller->excluir($_POST);
            } elseif ($subAcao === 'novo_admin' && $_SERVER['REQUEST_METHOD'] === 'POST') {
                $controller->criarAdmin($_POST);
            } else {
                $controller->index();
            }
        } elseif ($subModulo === 'pedidos') {
            require_once __DIR__ . '/../app/Controller/Admin/AdminPedidoController.php';
            $controller = new AdminPedidoController();
            
            if ($subAcao === 'atualizar' && $_SERVER['REQUEST_METHOD'] === 'POST') {
                $idPedido = isset($_GET['id']) ? (int)$_GET['id'] : 0;
                $controller->atualizarStatus($idPedido, $_POST['status'] ?? '');
            } elseif ($subAcao === 'relatorios') {
                // Nova rota para abrir a tela
                $controller->relatorios();
            } elseif ($subAcao === 'exportar') {
                // Nova rota para processar o download
                $controller->exportarDashboard();
            } else {
                $idPedido = isset($_GET['id']) ? (int)$_GET['id'] : 0;
                include_once __DIR__ . '/../app/View/Admin/pedidos_lista.php';
            }
        }
    break;

    // --- MÓDULO: CONFIGURAÇÕES ---
    case 'configuracoes':
        require_once __DIR__ . '/../app/Controller/UsuarioController.php';
        $usuarioController = new UsuarioController();
        
        if ($acao === 'atualizar' && $_SERVER['REQUEST_METHOD'] === 'POST') {
            $usuarioController->atualizarDados($_POST);
        } else {
            $usuarioController->configuracoes();
        }
    break;

    // --- ROTA NÃO ENCONTRADA (404) ---
    default:
        http_response_code(404);
        echo "<div style='background:#131313; height:100vh; display:flex; align-items:center; justify-content:center; flex-direction:column; color:#e5e2e1; font-family:sans-serif;'>";
        echo "<h1 style='color:#f95e14; font-size:3rem; margin-bottom:10px;'>Erro 404</h1>";
        echo "<p style='color:#d6c692; font-style:italic;'>Este plano místico não existe no Vácuo.</p>";
        echo "<a href='" . BASE_DIR . "/' style='color:#f95e14; margin-top:20px;'>Retornar ao mundo conhecido</a>";
        echo "</div>";
    break;
}
?>