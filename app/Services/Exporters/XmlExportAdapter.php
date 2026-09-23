<?php

require_once __DIR__ . '/ExportAdapterInterface.php';

class XmlExportAdapter implements ExportAdapterInterface {
    
    public function export(array $dadosVendas): string {
        $xml = new SimpleXMLElement('<?xml version="1.0" encoding="UTF-8"?><dashboard_vendas/>');

        foreach ($dadosVendas as $venda) {
            $transacao = $xml->addChild('transacao');
            
            foreach ($venda as $chave => $valor) {
                // Sanitiza a chave para evitar erros de sintaxe XML com espaços ou caracteres especiais
                $tag = preg_replace('/[^a-zA-Z0-9_]/', '', $chave);
                $transacao->addChild($tag, htmlspecialchars((string) $valor));
            }
        }

        return $xml->asXML();
    }

    public function getContentType(): string {
        return 'application/xml; charset=utf-8';
    }

    public function getFileExtension(): string {
        return 'xml';
    }
}
?>