<?php
    include_once __DIR__ . '/../Model/Produto.php';
    include_once __DIR__ . '/../Model/Categoria.php';
    include_once __DIR__ . '/../Model/Log.php';
    include_once __DIR__ . '/../Core/Session.php';
    include_once __DIR__ . '/../Middleware/AuthMiddleware.php';
    include_once __DIR__ . '/../Middleware/AdminMiddleware.php';

    class AdminProdutoController {
        private $produtoModel;
        private $logModel;

        public function __construct() {
            // Dupla checagem: deve estar logado E ser administrador
            AuthMiddleware::check();
            AdminMiddleware::check();
            
            $this->produtoModel = new Produto();
            $this->logModel = new Log();
        }

        // Exibe a lista de produtos no painel admin
        public function index() {
            // Em um sistema real, você teria um método findAdminAll() no Model 
            // para listar inclusive os sem estoque.
            $produtos = $this->produtoModel->findAll(); 
            include_once __DIR__ . '/../View/Admin/produtos_lista.php';
        }

        // Processa a criação de um novo produto (RN081)
        public function store($postData) {
            $nome = trim($postData['nome']);
            $idCategoria = (int) $postData['id_categoria'];
            $descricao = trim($postData['descricao']);
            $preco = (float) $postData['preco'];
            $estoque = (int) $postData['estoque'];
            $tipo = $postData['tipo']; // 'físico' ou 'virtual'
            $idUsuario = Session::get('user_id');

            if (empty($nome) || $preco < 0) {
                Session::set('erro', 'Dados inválidos. O valor não pode ser negativo e o nome é obrigatório.');
                header('Location: /admin/produtos/novo');
                exit;
            }

            // Lógica de inserção direta usando a conexão do PDO 
            // (Isso idealmente ficaria dentro de um método create() no Model Produto)
            $db = Database::getInstance();
            $stmt = $db->prepare("INSERT INTO produtos (id_categoria, nome, descricao, preco, estoque, tipo) VALUES (:cat, :nome, :desc, :preco, :estoque, :tipo)");
            
            $sucesso = $stmt->execute(array(
                'cat' => $idCategoria,
                'nome' => $nome,
                'desc' => $descricao,
                'preco' => $preco,
                'estoque' => $estoque,
                'tipo' => $tipo
            ));

            if ($sucesso) {
                $this->logModel->registrarAcao($idUsuario, "Criou o artefato comercial: {$nome}");
                Session::set('sucesso', 'Artefato forjado e adicionado ao comércio.');
            } else {
                Session::set('erro', 'Falha ao forjar o artefato.');
            }

            header('Location: /admin/produtos');
            exit;
        }
    }
?>