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
                            header('Location: /login');
                            exit;
                        }
                    } else {
                        // Banido_ate é nulo, logo é banimento permanente
                        Session::set('erro', 'Sua alma foi banida permanentemente. O Vácuo o rejeita.');
                        header('Location: /login');
                        exit;
                    }
                }

                // Se o status for ativo (ou foi perdoado agora), prossegue com o login
                Session::regenerate(); 
                Session::set('user_id', $usuario['id']);
                Session::set('user_name', $usuario['nome_usuario']);
                Session::set('user_role', $usuario['role']);

                header('Location: /campanhas');
                exit;
            }

            Session::set('erro', 'Credenciais inválidas. O Vácuo não reconhece você.');
            header('Location: /login');
            exit;
        }

        public function postCadastro($nome, $email, $senha, $senhaConfirmar) {
            if ($senha !== $senhaConfirmar) {
                Session::set('erro', 'As senhas não coincidem.');
                header('Location: /cadastro');
                exit;
            }

            if (strlen($senha) < 8) {
                Session::set('erro', 'A senha deve possuir no mínimo 8 caracteres.');
                header('Location: /cadastro');
                exit;
            }

            if ($this->usuarioModel->findByEmail($email)) {
                Session::set('erro', 'Este pergaminho já está vinculado a outro Escriba (Email em uso).');
                header('Location: /cadastro');
                exit;
            }

            if ($this->usuarioModel->create($nome, $email, $senha)) {
                Session::set('sucesso', 'Pacto selado com sucesso. Você já pode adentrar o Vácuo.');
                header('Location: /login');
                exit;
            } else {
                Session::set('erro', 'Uma falha mística ocorreu. Tente novamente.');
                header('Location: /cadastro');
                exit;
            }
        }

        public function logout() {
            Session::start();
            Session::destroy();
            header('Location: /');
            exit;
        }
    }
?>