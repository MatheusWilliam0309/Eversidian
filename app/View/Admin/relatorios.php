<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="utf-8"/>
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <title>Dashboards de Vendas | Painel do Mestre</title>
    <link href="https://fonts.googleapis.com/css2?family=Manrope:wght@300..700&family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet"/>
    <link href="<?= BASE_DIR ?>/Public/Assets/css/style.css" rel="stylesheet"/>
</head>
<body class="bg-[#050505] text-[#e5e2e1] font-body flex min-h-screen">
    
    <!-- Mantenha o menu lateral do seu painel admin aqui, caso tenha um arquivo header/sidebar -->
    
    <main class="flex-1 p-8">
        
        <header class="mb-10">
            <h1 class="text-3xl font-bold text-white mb-2 flex items-center gap-3">
                <span class="material-symbols-outlined text-[#f95e14] text-4xl">monitoring</span>
                Relatórios e Dashboards
            </h1>
            <p class="text-[#888]">Exporte os registros de transações forjadas no Eversidian.</p>
        </header>

        <!-- Grid de Opções de Exportação -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-8 max-w-4xl">
            
            <!-- Card de Exportação CSV (Excel) -->
            <div class="bg-[#111] border border-[#222] rounded p-8 flex flex-col items-center text-center hover:border-[#10b981] transition-colors group">
                <div class="w-20 h-20 bg-[#10b981]/10 rounded-full flex items-center justify-center mb-6 group-hover:scale-110 transition-transform">
                    <span class="material-symbols-outlined text-[#10b981] text-4xl">table_view</span>
                </div>
                <h3 class="text-xl font-bold text-white mb-3">Planilha CSV (Excel)</h3>
                <p class="text-[#888] text-sm mb-8 leading-relaxed">
                    Extrai todos os dados de pedidos num formato tabular padrão. Ideal para manipulação no Microsoft Excel ou Google Sheets para contabilidade.
                </p>
                <a href="<?= BASE_DIR ?>/admin/pedidos/exportar/csv" class="mt-auto px-6 py-3 bg-[#10b981]/10 text-[#10b981] border border-[#10b981] rounded uppercase text-xs font-bold tracking-wider hover:bg-[#10b981] hover:text-black transition-all w-full text-center">
                    Gerar e Baixar CSV
                </a>
            </div>

            <!-- Card de Exportação XML -->
            <div class="bg-[#111] border border-[#222] rounded p-8 flex flex-col items-center text-center hover:border-[#f95e14] transition-colors group">
                <div class="w-20 h-20 bg-[#f95e14]/10 rounded-full flex items-center justify-center mb-6 group-hover:scale-110 transition-transform">
                    <span class="material-symbols-outlined text-[#f95e14] text-4xl">code</span>
                </div>
                <h3 class="text-xl font-bold text-white mb-3">Estrutura XML</h3>
                <p class="text-[#888] text-sm mb-8 leading-relaxed">
                    Extrai os registros num formato de marcação hierárquica. Ideal para integrações com sistemas externos, ERPs ou APIs financeiras.
                </p>
                <a href="<?= BASE_DIR ?>/admin/pedidos/exportar/xml" class="mt-auto px-6 py-3 bg-[#f95e14]/10 text-[#f95e14] border border-[#f95e14] rounded uppercase text-xs font-bold tracking-wider hover:bg-[#f95e14] hover:text-white transition-all w-full text-center">
                    Gerar e Baixar XML
                </a>
            </div>

        </div>

    </main>

</body>
</html>