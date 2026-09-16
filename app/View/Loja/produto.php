<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="utf-8"/>
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <title><?= htmlspecialchars($produto['nome']) ?> | Arsenal do Vácuo</title>
    <link href="https://fonts.googleapis.com/css2?family=Newsreader:ital,opsz,wght@0,6..72,300..800;1,6..72,300..800&family=Manrope:wght@300..700&family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet"/>
    <link href="<?= BASE_DIR ?>/Public/Assets/css/style.css" rel="stylesheet"/>
    
    <!-- CSS BLINDADO (Garante o Layout Shopee mesmo se o Tailwind falhar) -->
    <style>
        .shopee-container {
            display: flex;
            flex-wrap: wrap;
            gap: 40px;
            background-color: #111111; /* Fundo do card principal */
            padding: 30px;
            border-radius: 4px;
            border: 1px solid rgba(255, 255, 255, 0.05);
        }
        .shopee-col-img {
            flex: 0 0 40%;
            max-width: 40%;
            min-width: 300px;
        }
        .shopee-col-info {
            flex: 1;
            min-width: 300px;
            display: flex;
            flex-direction: column;
        }
        .shopee-img-box {
            width: 100%;
            aspect-ratio: 1 / 1;
            background-color: #050505;
            display: flex;
            align-items: center;
            justify-content: center;
            position: relative;
        }
        .shopee-price-box {
            background-color: rgba(255, 255, 255, 0.03);
            padding: 20px;
            margin-bottom: 25px;
            display: flex;
            align-items: center;
        }
        .shopee-row {
            display: flex;
            align-items: flex-start;
            margin-bottom: 25px;
            gap: 20px;
        }
        .shopee-label {
            width: 90px;
            color: #888;
            font-size: 14px;
            margin-top: 4px;
        }
        /* Remove setas do input number */
        input[type=number]::-webkit-inner-spin-button, 
        input[type=number]::-webkit-outer-spin-button { -webkit-appearance: none; margin: 0; }
        input[type=number] { -moz-appearance: textfield; }
        
        /* Ajuste para telas pequenas (Celular) */
        @media (max-width: 800px) {
            .shopee-col-img { flex: 0 0 100%; max-width: 100%; }
        }
    </style>
</head>
<body class="bg-surface text-on-surface font-body flex flex-col min-h-screen">
    
    <?php include_once __DIR__ . '/../Components/header.php'; ?>

    <main class="flex-1 pt-32 pb-20 px-6 max-w-[75rem] mx-auto w-full">
        
        <!-- TRILHA / BREADCRUMBS -->
        <div class="mb-6 text-[10px] sm:text-xs font-bold uppercase tracking-widest text-secondary/60 flex items-center gap-2">
            <a href="<?= BASE_DIR ?>/loja" class="hover:text-primary transition-colors flex items-center gap-1 no-underline">
                <span class="material-symbols-outlined text-[14px]">arrow_back_ios</span>
                Retornar ao Arsenal
            </a>
            <span class="text-outline-variant">/</span>
            <span class="text-primary truncate"><?= htmlspecialchars($produto['nome']) ?></span>
        </div>

        <?php include_once __DIR__ . '/../Components/alertas.php'; ?>

        <!-- ========================================== -->
        <!-- ESTRUTURA PRINCIPAL (LAYOUT SHOPEE BLINDADO) -->
        <!-- ========================================== -->
        <div class="shopee-container shadow-[0_20px_50px_rgba(0,0,0,0.4)]">
            
            <!-- ESQUERDA: IMAGEM (Proporção 1:1 Quadrada) -->
            <div class="shopee-col-img">
                <div class="shopee-img-box border border-outline-variant/20 rounded-sm">
                    
                    <span class="absolute top-4 left-4 bg-[#111] border <?= strtolower($produto['tipo']) === 'virtual' ? 'border-[#3b82f6]/50 text-[#3b82f6]' : 'border-[#d6c692]/50 text-[#d6c692]' ?> text-[10px] font-bold px-2 py-1 rounded-sm uppercase tracking-wider z-20 shadow-lg">
                        <?= htmlspecialchars($produto['tipo']) ?>
                    </span>

                    <?php if(!empty($produto['imagem'])): ?>
                        <img src="<?= BASE_DIR ?>/Public/Uploads/<?= htmlspecialchars($produto['imagem']) ?>" 
                             alt="<?= htmlspecialchars($produto['nome']) ?>" 
                             style="max-width: 90%; max-height: 90%; object-fit: contain;">
                    <?php else: ?>
                        <span class="material-symbols-outlined text-outline/20 text-8xl">inventory_2</span>
                    <?php endif; ?>
                </div>
            </div>

            <!-- DIREITA: INFORMAÇÕES E BOTÕES -->
            <div class="shopee-col-info">
                
                <!-- Título -->
                <h1 class="font-headline text-2xl sm:text-3xl mb-4 text-on-surface leading-snug">
                    <?= htmlspecialchars($produto['nome']) ?>
                </h1>
                
                <!-- Caixa de Preço Destaque -->
                <div class="shopee-price-box border border-outline-variant/10 rounded-sm">
                    <span class="font-headline text-4xl text-primary font-bold tracking-wider">
                        R$ <?= number_format($produto['preco'], 2, ',', '.') ?>
                    </span>
                </div>

                <!-- Simulação de Frete -->
                <div class="shopee-row">
                    <span class="shopee-label">Frete</span>
                    <div class="flex flex-col gap-1">
                        <div class="flex items-center gap-2 text-on-surface text-sm">
                            <span class="material-symbols-outlined text-[20px] text-emerald-500">local_shipping</span>
                            <span>Envio para o Plano Material</span>
                        </div>
                        <span class="text-secondary/70 text-xs ml-7">Frete grátis com benção do Vácuo</span>
                    </div>
                </div>

                <!-- Formulário: Quantidade e Botões -->
                <form action="<?= BASE_DIR ?>/loja/adicionar" method="POST" class="mt-auto">
                    <input type="hidden" name="id_produto" value="<?= $produto['id'] ?>">
                    
                    <!-- Quantidade -->
                    <div class="shopee-row items-center">
                        <span class="shopee-label">Quantidade</span>
                        
                        <div class="flex items-center border border-outline-variant/30 rounded-sm h-10 bg-surface-container-lowest">
                            <button type="button" onclick="alterarQtd(-1)" class="w-10 h-full flex items-center justify-center text-secondary hover:bg-surface-container border-r border-outline-variant/30 transition-colors cursor-pointer">
                                <span class="material-symbols-outlined text-[16px]">remove</span>
                            </button>
                            
                            <input type="number" name="quantidade" id="input_qtd" value="1" min="1" max="99" class="w-16 h-full bg-transparent text-center text-on-surface font-bold focus:outline-none">
                            
                            <button type="button" onclick="alterarQtd(1)" class="w-10 h-full flex items-center justify-center text-secondary hover:bg-surface-container border-l border-outline-variant/30 transition-colors cursor-pointer">
                                <span class="material-symbols-outlined text-[16px]">add</span>
                            </button>
                        </div>
                    </div>

                    <!-- Botões de Ação (Lado a Lado) -->
                    <div class="flex gap-4 mt-6">
                        <button type="submit" class="flex-1 py-4 bg-primary-container/10 border border-primary-container text-primary-container rounded-sm flex items-center justify-center gap-2 hover:bg-primary-container/20 transition-colors cursor-pointer text-[12px] font-bold uppercase tracking-wider">
                            <span class="material-symbols-outlined text-[20px]">add_shopping_cart</span>
                            Adicionar Ao Carrinho
                        </button>
                        
                        <button type="button" class="flex-1 py-4 bg-primary text-on-primary rounded-sm flex items-center justify-center hover:bg-[#d44d0d] shadow-[0_0_15px_rgba(249,94,20,0.2)] transition-all cursor-pointer text-[12px] font-bold uppercase tracking-wider">
                            Comprar Agora
                        </button>
                    </div>
                </form>

            </div>
        </div>

        <!-- ========================================== -->
        <!-- SESSÃO DE DESCRIÇÃO -->
        <!-- ========================================== -->
        <div class="mt-8 bg-[#111] border border-outline-variant/10 rounded-sm p-8 shadow-xl">
            <h3 class="bg-surface-container px-4 py-3 text-lg font-headline text-on-surface mb-6 border-l-4 border-primary uppercase tracking-widest">
                Especificações do Artefato
            </h3>
            <p class="text-secondary/80 text-sm leading-relaxed text-justify whitespace-pre-line">
                <?= htmlspecialchars($produto['descricao']) ?>
            </p>
        </div>

    </main>

    <?php include_once __DIR__ . '/../Components/footer.php'; ?>

    <script>
        function alterarQtd(valor) {
            const input = document.getElementById('input_qtd');
            let atual = parseInt(input.value) || 1;
            let novoValor = atual + valor;
            if(novoValor >= 1 && novoValor <= 99) {
                input.value = novoValor;
            }
        }
    </script>
</body>
</html>