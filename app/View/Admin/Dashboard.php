<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="utf-8"/>
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <title>Painel de Mestre | Eversidian</title>
    <link href="https://fonts.googleapis.com/css2?family=Cinzel:wght@400;700&family=Inter:wght@300;400;600&family=Newsreader:ital,opsz,wght@0,6..72,300..800;1,6..72,300..800&family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet"/>
    <link href="/Public/Assets/css/style.css" rel="stylesheet"/>
</head>
<body class="bg-surface text-on-surface font-body overflow-x-hidden flex flex-col min-h-screen relative">
    
    <div id="particles" class="absolute inset-0 z-0 pointer-events-none overflow-hidden opacity-35"></div>

    <?php include_once __DIR__ . '/../Components/header.php'; ?>

    <main class="flex-1 pt-32 pb-20 px-6 max-w-[80rem] mx-auto w-full relative z-10">
        
        <section class="text-center mb-16 animate-[hero-in_1s_ease-out]">
            <span class="inline-block text-[0.65rem] tracking-[0.25em] uppercase text-primary font-semibold mb-3 px-4 py-1 border border-primary/25 rounded-full bg-primary/5">Nível Administrativo</span>
            <h1 class="font-headline text-5xl mb-3">Painel de <em class="text-primary italic">Mestre</em></h1>
            <p class="font-headline text-secondary italic text-xl opacity-80">Controle os artefatos, as almas dos escribas e as oferendas transacionadas no Vácuo.</p>
        </section>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            
            <div class="bg-surface-container border border-outline-variant/40 rounded-sm overflow-hidden flex flex-col justify-between p-8 transition-all duration-300 group hover:border-primary hover:-translate-y-1 hover:shadow-xl relative">
                <span class="material-symbols-outlined absolute -bottom-6 -right-6 text-[8rem] opacity-[0.03] transition-opacity duration-300 group-hover:opacity-[0.07] pointer-events-none" style="font-variation-settings: 'FILL' 1;">inventory_2</span>
                <div>
                    <div class="w-12 h-12 bg-[#f95e14]/10 flex items-center justify-center rounded mb-6 border border-primary-container/20">
                        <span class="material-symbols-outlined text-primary text-3xl">swords</span>
                    </div>
                    <h3 class="font-headline text-2xl text-on-surface mb-3">Gerenciamento de Artefatos</h3>
                    <p class="text-[#d6c692]/65 text-sm leading-relaxed mb-6">
                        Forje novos itens comerciais, gerencie o estoque físico ou altere os parâmetros dos conhecimentos arcanos digitais através do motor de Fábricas.
                    </p>
                </div>
                <a href="/admin/produtos" class="block text-center border border-outline/30 py-3 text-secondary text-xs font-bold uppercase tracking-widest hover:bg-primary-container hover:text-on-primary-container hover:border-primary-container transition-all no-underline">
                    Abrir Arsenal
                </a>
            </div>

            <div class="bg-surface-container border border-outline-variant/40 rounded-sm overflow-hidden flex flex-col justify-between p-8 transition-all duration-300 group hover:border-primary hover:-translate-y-1 hover:shadow-xl relative">
                <span class="material-symbols-outlined absolute -bottom-6 -right-6 text-[8rem] opacity-[0.03] transition-opacity duration-300 group-hover:opacity-[0.07] pointer-events-none" style="font-variation-settings: 'FILL' 1;">gavel</span>
                <div>
                    <div class="w-12 h-12 bg-[#f95e14]/10 flex items-center justify-center rounded mb-6 border border-primary-container/20">
                        <span class="material-symbols-outlined text-primary text-3xl">gavel</span>
                    </div>
                    <h3 class="font-headline text-2xl text-on-surface mb-3">Controle de Almas</h3>
                    <p class="text-[#d6c692]/65 text-sm leading-relaxed mb-6">
                        Monitore os pactos ativos dos escribas inscritos, aplique exílios temporários ou ordene banimentos permanentes diretamente para o fundo do Vácuo.
                    </p>
                </div>
                <a href="/admin/usuarios" class="block text-center border border-outline/30 py-3 text-secondary text-xs font-bold uppercase tracking-widest hover:bg-primary-container hover:text-on-primary-container hover:border-primary-container transition-all no-underline">
                    Auditar Escribas
                </a>
            </div>

            <div class="bg-surface-container border border-outline-variant/40 rounded-sm overflow-hidden flex flex-col justify-between p-8 transition-all duration-300 group hover:border-primary hover:-translate-y-1 hover:shadow-xl relative">
                <span class="material-symbols-outlined absolute -bottom-6 -right-6 text-[8rem] opacity-[0.03] transition-opacity duration-300 group-hover:opacity-[0.07] pointer-events-none" style="font-variation-settings: 'FILL' 1;">payments</span>
                <div>
                    <div class="w-12 h-12 bg-[#f95e14]/10 flex items-center justify-center rounded mb-6 border border-primary-container/20">
                        <span class="material-symbols-outlined text-primary text-3xl">account_balance_wallet</span>
                    </div>
                    <h3 class="font-headline text-2xl text-on-surface mb-3">Oferendas & Pedidos</h3>
                    <p class="text-[#d6c692]/65 text-sm leading-relaxed mb-6">
                        Controle o fluxo financeiro de transações, aprove selos de pagamento pendentes e altere o estágio de entrega das mercadorias adquiridas.
                    </p>
                </div>
                <a href="/admin/pedidos" class="block text-center border border-outline/30 py-3 text-secondary text-xs font-bold uppercase tracking-widest hover:bg-primary-container hover:text-on-primary-container hover:border-primary-container transition-all no-underline">
                    Ver Transações
                </a>
            </div>

        </div>

        <section class="mt-16 bg-surface-container-lowest border border-outline-variant/20 rounded p-6">
            <div class="flex items-center gap-3 mb-4">
                <span class="material-symbols-outlined text-primary text-xl">terminal</span>
                <h4 class="font-headline text-lg text-secondary">Status Operacional do Grimório</h4>
            </div>
            <p class="text-xs text-secondary/50 font-mono leading-relaxed">
                [SISTEMA]: Segurança de Rotas ativa contra redundância estrutural de endereçamento.<br/>
                [PADRÃO]: Factory Method integrado com sucesso para segregação de Artefatos Físicos e Digitais.
            </p>
        </section>

    </main>

    <?php include_once __DIR__ . '/../Components/footer.php'; ?>

    <script>
        /* Injeção de Partículas Atmosféricas */
        const container = document.getElementById('particles');
        for (let i = 0; i < 15; i++) {
            const p = document.createElement('div');
            p.className = 'absolute w-0.5 h-0.5 bg-primary rounded-full opacity-0 animate-particle';
            p.style.cssText = `
                left: ${Math.random() * 100}%;
                --dur: ${7 + Math.random() * 8}s;
                --delay: ${Math.random() * 5}s;
                --drift: ${(Math.random() - 0.5) * 60}px;
            `;
            container.appendChild(p);
        }
    </script>
</body>
</html>