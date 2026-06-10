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
            $usuarioModel = new Usuario();
            $user = $usuarioModel->findByEmail($email); 

            if ($user && password_verify($senha, $user['senha'])) {
                
                // --- VERIFICAÇÃO DE JULGAMENTO (BANIMENTO) ---
                if ($user['status'] === 'banido' || $user['status'] === 'exilado') {
                    
                    if (!empty($user['banido_ate'])) {
                        
                        // Define o fuso horário oficial de Brasília
                        $fusoHorario = new DateTimeZone('America/Sao_Paulo');
                        
                        // Instancia as datas forçando o fuso correto
                        $dataExpiracao = new DateTime($user['banido_ate'], $fusoHorario);
                        $agora = new DateTime('now', $fusoHorario);

                        if ($agora < $dataExpiracao) {
                            // Ainda está no período de exílio (Mostra Data e Hora)
                            $dataFormatada = $dataExpiracao->format('d/m/Y \à\s H:i');
                            Session::set('erro', "Sua alma está em exílio temporário. O Vácuo o aceitará novamente em {$dataFormatada}.");
                            header('Location: ' . BASE_DIR . '/login');
                            exit;
                        } else {
                            // A pena já foi cumprida! O sistema liberta a alma automaticamente.
                            // Opcional: Atualizar no banco para status 'ativo' e limpar a coluna 'banido_ate'
                            $usuarioModel->restaurarStatus($user['id']); 
                        }
                    } else {
                        // É um banimento eterno (a coluna banido_ate está vazia/nula)
                        Session::set('erro', 'Sua alma foi banida permanentemente. O Vácuo o rejeita.');
                        header('Location: ' . BASE_DIR . '/login');
                        exit;
                    }
                }

                // --- LOGIN BEM-SUCEDIDO ---
                Session::set('user_id', $user['id']);
                Session::set('user_name', $user['nome_usuario']);
                Session::set('user_email', $user['email']);
                Session::set('user_role', $user['role']);
                Session::set('user_foto_perfil', $user['foto_perfil'] ?? null); 

                header('Location: ' . BASE_DIR . '/');
                exit;

            } else {
                Session::set('erro', 'Credenciais inválidas. O feitiço falhou.');
                header('Location: ' . BASE_DIR . '/login');
                exit;
            }
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
            $senhaHash = password_hash($senha, PASSWORD_ARGON2ID);
    
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