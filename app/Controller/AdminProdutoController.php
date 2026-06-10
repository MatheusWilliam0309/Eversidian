<?php
    include_once __DIR__ . '/../Model/Produto.php';
    include_once __DIR__ . '/../Model/Categoria.php';
    include_once __DIR__ . '/../Model/Log.php';
    include_once __DIR__ . '/../Core/Session.php';
    include_once __DIR__ . '/../Middleware/AuthMiddleware.php';
    include_once __DIR__ . '/../Middleware/AdminMiddleware.php';
    
    // Inclusão das fábricas abstratas existentes para o Factory Method
    include_once __DIR__ . '/../Helpers/Factories/LojaFisicaFactory.php';
    include_once __DIR__ . '/../Helpers/Factories/LojaVirtualFactory.php';

    class AdminProdutoController {
        private $produtoModel;
        private $logModel;

        public function __construct() {
            AuthMiddleware::check();
            AdminMiddleware::check();
            
            $this->produtoModel = new Produto();
            $this->logModel = new Log();
        }

        // --- FACTORY METHOD ---
        // Delega e retorna o criador de objetos correto sem acoplar o controlador
        protected function obterLojaFactory($tipo) {
            // Normaliza para comparar sem problemas de caixa alta/baixa
            if (strcasecmp($tipo, 'físico') === 0 || strcasecmp($tipo, 'fisico') === 0) {
                return new LojaFisicaFactory();
            }
            return new LojaVirtualFactory();
        }

        public function index() {
            $produtos = $this->produtoModel->findAll(); 
            include_once __DIR__ . '/../View/Admin/produtos_lista.php';
        }

        public function store($postData) {
            $nome = trim($postData['nome']);
            $idCategoria = (int) $postData['id_categoria'];
            $descricao = trim($postData['descricao']);
            $preco = (float) $postData['preco'];
            $estoque = (int) $postData['estoque'];
            $tipo = trim($postData['tipo']); 
            $idUsuario = Session::get('user_id');

            // --- LÓGICA DE UPLOAD DE IMAGEM ---
            $imagemNome = 'default_item.png'; // Fallback de segurança
            if (isset($_FILES['imagem']) && $_FILES['imagem']['error'] === UPLOAD_ERR_OK) {
                $extensao = strtolower(pathinfo($_FILES['imagem']['name'], PATHINFO_EXTENSION));
                $extensoesPermitidas = ['jpg', 'jpeg', 'png', 'webp'];
                
                if (in_array($extensao, $extensoesPermitidas)) {
                    $imagemNome = uniqid('item_') . '.' . $extensao;
                    $diretorioDestino = __DIR__ . '/../../Public/Uploads/' . $imagemNome;
                    move_uploaded_file($_FILES['imagem']['tmp_name'], $diretorioDestino);
                } else {
                    Session::set('erro', 'A magia da imagem falhou. Use apenas JPG, PNG ou WEBP.');
                    header('Location: ' . BASE_DIR . '/admin/produtos');
                    exit;
                }
            } else {
                Session::set('erro', 'É obrigatório anexar uma imagem (Selo Visual) ao artefato.');
                header('Location: ' . BASE_DIR . '/admin/produtos');
                exit;
            }

            $factory = $this->obterLojaFactory($tipo);
            $produtoConceito = $factory->instanciarProduto(['nome' => $nome, 'tipo' => $tipo]);

            if (!$produtoConceito->precisaBaixarEstoque()) {
                $estoque = 0; 
            }

            // Agora passamos a variável $imagemNome
            $sucesso = $this->produtoModel->create($idCategoria, $nome, $descricao, $preco, $estoque, $tipo, $imagemNome);

            if ($sucesso) {
                $this->logModel->registrarAcao($idUsuario, "Forjou o artefato com imagem: {$produtoConceito->getDetalhes()}");
                Session::set('sucesso', 'Artefato forjado e adicionado ao comércio.');
            } else {
                Session::set('erro', 'Falha ao forjar o artefato nas tabelas do Vácuo.');
            }

            header('Location: ' . BASE_DIR . '/admin/produtos');
            exit;
        }
    }
?>