<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="utf-8"/>
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <title>Arsenal do Vácuo | Eversidian</title>
    <link href="https://fonts.googleapis.com/css2?family=Newsreader:ital,opsz,wght@0,6..72,300..800;1,6..72,300..800&family=Manrope:wght@300..700&family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet"/>
    <link href="./public/assets/css/style.css" rel="stylesheet"/>
</head>
<body class="bg-surface text-on-surface font-body flex flex-col min-h-screen">
    <?php include_once __DIR__ . '/../Components/header.php'; ?>

    <main class="flex-1 pt-32 pb-20 px-6 max-w-[80rem] mx-auto w-full">
        <div class="flex justify-between items-end mb-12">
            <div>
                <h1 class="font-headline text-5xl mb-4">O <em class="text-primary italic">Arsenal</em></h1>
                <p class="font-headline text-secondary italic text-xl">Adquira artefatos físicos e conhecimentos digitais para sua jornada.</p>
            </div>
            <a href="/loja/carrinho" class="p-3 bg-surface-container border border-outline-variant/50 rounded hover:border-primary transition-colors flex items-center gap-2 no-underline">
                <span class="material-symbols-outlined text-primary">shopping_bag</span>
                <span class="text-xs font-bold uppercase tracking-wider hidden md:block">Ver Bolsa</span>
            </a>
        </div>

        <?php if(isset($_SESSION['sucesso'])): ?>
            <div class="bg-[#d6c692]/10 border border-[#d6c692]/30 text-[#d6c692] p-4 rounded mb-8 text-sm text-center">
                <?= $_SESSION['sucesso']; unset($_SESSION['sucesso']); ?>
            </div>
        <?php endif; ?>

        <div class="grid grid-cols-1 md:grid-cols-3 lg:grid-cols-4 gap-6">
            <?php if(isset($produtos)): ?>
                <?php foreach ($produtos as $produto): ?>
                <div class="bg-surface-container border border-outline-variant/40 rounded-sm overflow-hidden flex flex-col group hover:-translate-y-1 transition-all hover:shadow-[0_16px_40px_rgba(0,0,0,0.4)]">
                    
                    <div class="h-48 relative bg-surface-container-lowest flex items-center justify-center overflow-hidden">
                        <?php if(!empty($produto['imagem'])): ?>
                            <img src="<?= htmlspecialchars($produto['imagem']) ?>" alt="<?= htmlspecialchars($produto['nome']) ?>" class="w-full h-full object-cover opacity-80 group-hover:opacity-100 transition-opacity duration-500">
                        <?php else: ?>
                            <span class="material-symbols-outlined text-outline/20 text-6xl">inventory_2</span>
                        <?php endif; ?>
                        <span class="absolute top-3 left-3 bg-surface-container-high border border-outline-variant/50 text-secondary text-[10px] font-bold px-2 py-1 rounded uppercase tracking-wider">
                            <?= htmlspecialchars($produto['tipo']) ?>
                        </span>
                    </div>
                    
                    <div class="p-5 flex-1 flex flex-col">
                        <h3 class="font-headline text-xl mb-2 text-on-surface"><?= htmlspecialchars($produto['nome']) ?></h3>
                        <p class="text-secondary/60 text-xs mb-4 line-clamp-2"><?= htmlspecialchars($produto['descricao']) ?></p>
                        
                        <div class="mt-auto flex items-center justify-between">
                            <span class="font-headline text-2xl text-primary">R$ <?= number_format($produto['preco'], 2, ',', '.') ?></span>
                            
                            <form action="/loja/adicionar" method="POST">
                                <input type="hidden" name="id_produto" value="<?= $produto['id'] ?>">
                                <input type="hidden" name="quantidade" value="1">
                                <button type="submit" class="p-2 bg-primary-container/10 border border-primary-container text-primary-container rounded hover:bg-primary-container hover:text-on-primary-container transition-colors cursor-pointer" title="Adicionar à bolsa">
                                    <span class="material-symbols-outlined text-sm">add_shopping_cart</span>
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>
    </main>

    <?php include_once __DIR__ . '/../Components/footer.php'; ?>
</body>
</html>