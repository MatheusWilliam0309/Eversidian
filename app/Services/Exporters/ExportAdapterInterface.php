<?php

interface ExportAdapterInterface {
    /**
     * Converte o array de vendas para o formato específico (string).
     */
    public function export(array $dadosVendas): string;

    /**
     * Retorna o MIME type para os headers HTTP de download.
     */
    public function getContentType(): string;

    /**
     * Retorna a extensão do arquivo (ex: 'csv', 'xml').
     */
    public function getFileExtension(): string;
}
?>