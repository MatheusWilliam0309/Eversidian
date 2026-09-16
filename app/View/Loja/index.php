<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="utf-8"/>
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <title>Arsenal do Vácuo | Eversidian</title>
    <link href="https://fonts.googleapis.com/css2?family=Newsreader:ital,opsz,wght@0,6..72,300..800;1,6..72,300..800&family=Manrope:wght@300..700&family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet"/>
    
    <!-- Caminho absoluto garantido para o seu CSS -->
    <link href="/Eversidian/Public/Assets/css/style.css" rel="stylesheet"/>
</head>
<body class="bg-surface text-on-surface font-body flex flex-col min-h-screen">
    
    <?php include_once __DIR__ . '/../Components/header.php'; ?>

    <main class="flex-1 pt-32 pb-20 px-6 max-w-[80rem] mx-auto w-full">
        <div class="flex justify-between items-end mb-12">
            <div>
                <h1 class="font-headline text-5xl mb-4">O <em class="text-primary italic">Arsenal</em></h1>
                <p class="font-headline text-secondary italic text-xl">Adquira artefatos físicos e conhecimentos digitais para sua jornada.</p>
            </div>
            
            <a href="/Eversidian/loja/carrinho" class="p-3 bg-surface-container border border-outline-variant/50 rounded hover:border-primary transition-colors flex items-center gap-2 no-underline">
                <span class="material-symbols-outlined text-primary">shopping_bag</span>
                <span class="text-xs font-bold uppercase tracking-wider hidden md:block">Ver Bolsa</span>
            </a>
        </div>

        <?php include_once __DIR__ . '/../Components/alertas.php'; ?>

        <!-- Estilo Grid Nativo Injetado: Ignora se o Tailwind não estiver compilado e alinha perfeitamente -->
        <div style="display: grid; grid-template-columns: repeat(auto-fill, minmax(280px, 1fr)); gap: 1.5rem;">
            
            <?php if(isset($produtos) && !empty($produtos)): ?>
                <?php foreach ($produtos as $produto): ?>
                    <div class="bg-surface-container border border-outline-variant/40 rounded-sm overflow-hidden flex flex-col group hover:-translate-y-1 transition-all hover:shadow-[0_16px_40px_rgba(0,0,0,0.4)]">
                    
                    <!-- 1. VITRINE DA IMAGEM (Agora é um link seguro) -->
                    <a href="<?= BASE_DIR ?>/loja/produto/<?= $produto['id'] ?>" class="block w-full relative bg-[#050505] flex items-center justify-center overflow-hidden cursor-pointer" style="height: 300px;">
                        
                        <?php if(!empty($produto['imagem'])): ?>
                            <img src="<?= BASE_DIR ?>/Public/Uploads/<?= htmlspecialchars($produto['imagem']) ?>" 
                                 alt="<?= htmlspecialchars($produto['nome']) ?>" 
                                 class="w-full h-full opacity-90 group-hover:opacity-100 transition-opacity duration-500"
                                 style="object-fit: contain; padding: 1rem;">
                        <?php else: ?>
                            <span class="material-symbols-outlined text-outline/20 text-6xl">inventory_2</span>
                        <?php endif; ?>
                        
                        <!-- 2. SELO DA NATUREZA -->
                        <span class="absolute top-4 left-4 bg-surface-container-high border <?= strtolower($produto['tipo']) === 'virtual' ? 'border-[#3b82f6]/50 text-[#3b82f6]' : 'border-outline-variant/50 text-secondary' ?> text-[10px] font-bold px-2.5 py-1.5 rounded-sm uppercase tracking-wider z-20 shadow-lg">
                            <?= htmlspecialchars($produto['tipo']) ?>
                        </span>

                    </a> <!-- AQUI ESTAVA O PROBLEMA: Esta tag precisava ser </a> e não </div> -->
                    
                    <!-- 3. INFORMAÇÕES E AÇÃO -->
                    <div class="p-5 bg-surface-container border-t border-outline-variant/20 flex flex-col gap-3">
                        
                        <!-- Nome do Artefato (Link) -->
                        <a href="<?= BASE_DIR ?>/loja/produto/<?= $produto['id'] ?>" class="hover:text-primary transition-colors no-underline">
                            <h3 class="font-headline text-lg text-on-surface line-clamp-1" title="<?= htmlspecialchars($produto['nome']) ?>">
                                <?= htmlspecialchars($produto['nome']) ?>
                            </h3>
                        </a>
                        
                        <!-- Preço e Botão de Compra -->
                        <div class="flex items-center justify-between mt-1">
                            <span class="font-headline text-2xl text-primary font-bold tracking-wider">
                                R$ <?= number_format($produto['preco'], 2, ',', '.') ?>
                            </span>
                            
                            <form action="<?= BASE_DIR ?>/loja/adicionar" method="POST">
                                <input type="hidden" name="id_produto" value="<?= $produto['id'] ?>">
                                <input type="hidden" name="quantidade" value="1">
                                <button type="submit" class="p-2.5 bg-primary-container/10 border border-primary-container text-primary-container rounded-sm hover:bg-primary-container hover:text-on-primary-container transition-colors cursor-pointer" title="Adicionar à bolsa">
                                    <span class="material-symbols-outlined text-[18px]">add_shopping_cart</span>
                                </button>
                            </form>
                        </div>
                        
                    </div>
                    
                </div>
                <?php endforeach; ?>
            <?php else: ?>
                <div class="col-span-full py-12 text-center text-secondary/50 text-sm uppercase tracking-widest font-bold">
                    Os cofres do arsenal estão temporariamente vazios.
                </div>
            <?php endif; ?>
            
        </div>
    </main>

    <?php include_once __DIR__ . '/../Components/footer.php'; ?>
</body>
</html>