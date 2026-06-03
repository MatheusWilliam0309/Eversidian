<?php
    include_once __DIR__ . '/../Model/Usuario.php';
    include_once __DIR__ . '/../Core/Session.php';

    class AuthController {
        private $usuarioModel;

        public function __construct() {
            $this->usuarioModel = new Usuario();
            Session::start();
        }

        public function postLogin($email, $senha) {
            $usuario = $this->usuarioModel->findByEmail($email);

            if ($usuario && password_verify($senha, $usuario['senha'])) {
                
                // Verificação do Purgatório (Sistema de Banimento)
                if ($usuario['status'] === 'banido') {
                    if ($usuario['banido_ate'] !== null) {
                        $dataExpiracao = strtotime($usuario['banido_ate']);
                        
                        if (time() > $dataExpiracao) {
                            // O tempo de punição expirou. A alma está perdoada.
                            $this->usuarioModel->revogarBanimento($usuario['id']);
                            $usuario['status'] = 'ativo'; 
                        } else {
                            // Ainda está banido temporariamente
                            $dataAtualizada = date('d/m/Y \à\s H:i', $dataExpiracao);
                            Session::set('erro', "Sua alma foi exilada do Vácuo até {$dataAtualizada}. Aguarde sua redenção.");
                            header('Location:' . BASE_DIR . ' /login');
                            exit;
                        }
                    } else {
                        // Banido_ate é nulo, logo é banimento permanente
                        Session::set('erro', 'Sua alma foi banida permanentemente. O Vácuo o rejeita.');
                        header('Location:' . BASE_DIR . ' /login');
                        exit;
                    }
                }

                // Se o status for ativo (ou foi perdoado agora), prossegue com o login
                Session::regenerate(); 
                Session::set('user_id', $usuario['id']);
                Session::set('user_name', $usuario['nome_usuario']);
                Session::set('user_role', $usuario['role']);

                header('Location:' . BASE_DIR . ' /campanhas');
                exit;
            }

            Session::set('erro', 'Credenciais inválidas. O Vácuo não reconhece você.');
            header('Location:' . BASE_DIR . ' /login');
            exit;
        }

        public function postCadastro($postData) {
            // Higienização básica dos dados de entrada
            $nome = trim($postData['nome_usuario']);
            $email = trim($postData['email']);
            $senha = $postData['senha'];
    
            // 1. Validação de campos vazios
            if (empty($nome) || empty($email) || empty($senha)) {
                Session::set('erro', 'Todos os selos devem ser preenchidos para concluir o rito.');
                header('Location: ' . BASE_DIR . '/cadastro');
                exit;
            }
    
            // 2. Verifica se o Vácuo já possui este email ou utilizador
            if ($this->usuarioModel->checkExists($email, $nome)) {
                Session::set('erro', 'Esta identidade ou selo de contacto já estão gravados nas pedras. Escolha outros.');
                header('Location: ' . BASE_DIR . '/cadastro');
                exit;
            }
    
            // 3. Validação do tamanho da palavra-passe (Opcional, mas recomendado)
            if (strlen($senha) < 6) {
                Session::set('erro', 'Sua palavra de poder é demasiado fraca. Use pelo menos 6 caracteres.');
                header('Location: ' . BASE_DIR . '/cadastro');
                exit;
            }
    
            // 4. Encriptação segura da palavra-passe (NUNCA guardar em texto limpo)
            $senhaHash = password_hash($senha, PASSWORD_DEFAULT);
    
            // 5. Tenta criar o registo na base de dados
            if ($this->usuarioModel->create($nome, $email, $senhaHash)) {
                // Registo bem-sucedido: Redireciona para o Login com mensagem de sucesso
                Session::set('sucesso', 'O seu pacto foi selado com sucesso. Pode despertar agora.');
                header('Location: ' . BASE_DIR . '/login');
            } else {
                // Falha genérica (ex: erro no servidor de base de dados)
                Session::set('erro', 'As estrelas não estão alinhadas. Falha ao forjar o pacto.');
                header('Location: ' . BASE_DIR . '/cadastro');
            }
            
            exit;
        }

        public function logout() {
            Session::start();
            Session::destroy();
            header('Location:' . BASE_DIR . ' /');
            exit;
        }
    }
?>