<!DOCTYPE html>
<html lang="pt-BR">
    <head>
        <meta charset="utf-8"/>
        <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
        <title>Campanhas | Eversidian</title>
        <link href="https://fonts.googleapis.com/css2?family=Newsreader:ital,opsz,wght@0,6..72,300..800;1,6..72,300..800&family=Manrope:wght@300..700&family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet"/>
        <link href="./Public/assets/css/style.css" rel="stylesheet"/>
    </head>
    <body class="bg-surface text-on-surface font-body flex flex-col min-h-screen">
        <?php include_once __DIR__ . '/../Components/header.php'; ?>

        <main class="flex-1 pt-32 pb-20 px-6 max-w-[80rem] mx-auto w-full">
            <div class="text-center mb-12">
                <h1 class="font-headline text-5xl mb-4">Seus <em class="text-primary italic">Reinos</em></h1>
                <p class="font-headline text-secondary italic text-xl">Retorne aos mundos que você forjou ou inicie uma nova lenda.</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                <a href="/campanhas/nova" class="no-underline">
                    <div class="border-2 border-dashed border-outline-variant/30 rounded-sm p-10 flex flex-col items-center justify-center group hover:border-primary transition-all cursor-pointer min-h-[300px] h-full">
                        <span class="material-symbols-outlined text-5xl text-primary mb-4 group-hover:scale-110 transition-transform">add_circle</span>
                        <h3 class="font-headline text-xl text-secondary">Forjar Nova Campanha</h3>
                    </div>
                </a>

                <?php if(isset($listaCampanhas)): ?>
                    <?php foreach ($listaCampanhas as $campanha): ?>
                    <div class="bg-surface-container border border-outline-variant/40 rounded-sm overflow-hidden flex flex-col hover:-translate-y-1 transition-all hover:shadow-xl">
                        <div class="h-40 relative bg-surface-container-high border-b border-outline-variant/30 flex items-center justify-center">
                            <span class="material-symbols-outlined text-outline/20 text-6xl">public</span>
                            <span class="absolute top-4 right-4 bg-primary-container text-on-primary-container text-[10px] font-bold px-2 py-1 rounded-sm uppercase"><?= htmlspecialchars($campanha['status']) ?></span>
                        </div>
                        <div class="p-6 flex-1 flex flex-col">
                            <h3 class="font-headline text-2xl mb-4"><?= htmlspecialchars($campanha['titulo']) ?></h3>
                            <div class="flex gap-4 text-xs text-secondary/60 mb-6 font-semibold uppercase tracking-wider">
                                <span class="flex items-center gap-1"><span class="material-symbols-outlined text-sm">group</span> <?= $campanha['max_jogadores'] ?> Vagas</span>
                            </div>
                            <a href="/campanhas/detalhes?id=<?= $campanha['id'] ?>" class="mt-auto block text-center border border-outline/30 py-3 text-secondary text-xs font-bold uppercase tracking-widest hover:bg-primary-container hover:text-on-primary-container transition-colors no-underline">Assumir o Manto</a>
                        </div>
                    </div>
                    <?php endforeach; ?>
                <?php endif; ?>
            </div>
        </main>

        <?php include_once __DIR__ . '/../Components/footer.php'; ?>
    </body>
</html>