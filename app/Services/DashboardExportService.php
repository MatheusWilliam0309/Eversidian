<?php

class DashboardExportService {
    // A única instância permitida na aplicação
    private static ?DashboardExportService $instancia = null;

    // Bloqueia a criação via "new", clonagem ou desserialização
    private function __construct() {}
    private function __clone() {}
    public function __wakeup() {
        throw new Exception("Não é permitido desserializar um Singleton.");
    }

    /**
     * Retorna a instância única do serviço.
     */
    public static function getInstance(): DashboardExportService {
        if (self::$instancia === null) {
            self::$instancia = new self();
        }
        return self::$instancia;
    }

    /**
     * Orquestra a geração do dashboard delegando a conversão ao Adaptador.
     */
    public function gerarRelatorio(array $dadosVendas, ExportAdapterInterface $adaptador): array {
        $conteudo = $adaptador->export($dadosVendas);
        $extensao = $adaptador->getFileExtension();
        $contentType = $adaptador->getContentType();
        
        $nomeArquivo = "eversidian_vendas_" . date('Ymd_His') . "." . $extensao;

        return [
            'conteudo'     => $conteudo,
            'content_type' => $contentType,
            'nome_arquivo' => $nomeArquivo
        ];
    }
}
?>