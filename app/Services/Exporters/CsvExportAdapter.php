<?php

require_once __DIR__ . '/ExportAdapterInterface.php';

class CsvExportAdapter implements ExportAdapterInterface {
    
    public function export(array $dadosVendas): string {
        if (empty($dadosVendas)) {
            return "Nenhum dado encontrado.";
        }

        // Abre um buffer de memória para não precisar salvar arquivo físico temporário
        $output = fopen('php://temp', 'r+');
        
        // Escreve os cabeçalhos (pegando as chaves do primeiro array)
        // Usamos ponto e vírgula (;) pois é o padrão lido nativamente pelo Excel no Brasil
        fputcsv($output, array_keys($dadosVendas[0]), ';');

        // Escreve as linhas de dados
        foreach ($dadosVendas as $linha) {
            fputcsv($output, $linha, ';');
        }

        rewind($output);
        $csvData = stream_get_contents($output);
        fclose($output);

        return $csvData;
    }

    public function getContentType(): string {
        return 'text/csv; charset=utf-8';
    }

    public function getFileExtension(): string {
        return 'csv';
    }
}
?>