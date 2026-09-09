<?php

class Upload {
    
    /**
     * Move o selo visual (imagem) para o cofre físico do servidor.
     * Cria a pasta automaticamente se ela não existir.
     * 
     * @param array $arquivo O ficheiro vindo de $_FILES['imagem']
     * @param string $diretorio O caminho relativo a partir da raiz do projeto
     * @return string|bool Retorna o novo nome da imagem ou false em caso de erro
     */
    public static function imagem($arquivo, $diretorio = 'Public/Uploads') {
        
        // Verifica se o ficheiro existe e se houve algum erro no upload
        if (!isset($arquivo['name']) || $arquivo['error'] !== UPLOAD_ERR_OK) {
            return false;
        }

        // Validação de Segurança: Apenas imagens são permitidas no Eversidian
        $tiposPermitidos = ['image/jpeg', 'image/png', 'image/webp'];
        if (!in_array($arquivo['type'], $tiposPermitidos)) {
            return false;
        }

        // Descobre o caminho absoluto da raiz do projeto no seu Windows (C:\xampp\htdocs\Eversidian)
        $raizProjeto = dirname(__DIR__, 2); 
        $caminhoCompleto = $raizProjeto . DIRECTORY_SEPARATOR . $diretorio;

        // A Mágica: Se a pasta "Public/Uploads" não existir, o PHP cria-a agora!
        if (!is_dir($caminhoCompleto)) {
            mkdir($caminhoCompleto, 0777, true);
        }

        // Forja um nome único para a imagem (Evita que uma espada sobreponha a outra)
        $extensao = pathinfo($arquivo['name'], PATHINFO_EXTENSION);
        $novoNome = 'artefato_' . uniqid() . '_' . time() . '.' . $extensao;

        // O destino final físico
        $destino = $caminhoCompleto . DIRECTORY_SEPARATOR . $novoNome;

        // Move a imagem do limbo temporário do XAMPP para a pasta oficial
        if (move_uploaded_file($arquivo['tmp_name'], $destino)) {
            return $novoNome; // Sucesso! Retorna apenas o nome (ex: artefato_64a1b...jpg)
        }

        return false;
    }
}