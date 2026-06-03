<header class="fixed top-0 w-full bg-surface/85 backdrop-blur-md border-b border-outline-variant/30 z-50 transition-all duration-300">
    <div class="max-w-[90rem] mx-auto px-6 h-20 flex items-center justify-between">
        <a href="/" class="flex items-center gap-3 group no-underline">
            <span class="material-symbols-outlined text-primary text-3xl transition-transform group-hover:scale-110">menu_book</span>
            <span class="font-headline text-2xl text-on-surface tracking-wide">Eversidian</span>
        </a>
        
        <nav class="hidden lg:flex items-center gap-8">
            <a href="/campanhas" class="text-secondary/80 hover:text-primary text-sm font-bold uppercase tracking-widest transition-colors no-underline">Campanhas</a>
            <a href="/cronicas" class="text-secondary/80 hover:text-primary text-sm font-bold uppercase tracking-widest transition-colors no-underline">Crônicas</a>
            <a href="/loja" class="text-secondary/80 hover:text-primary text-sm font-bold uppercase tracking-widest transition-colors no-underline">Arsenal</a>
        </nav>

        <div class="flex items-center gap-4">
            <?php if (isset($_SESSION['user_id'])): ?>
                <a href="/perfil" class="text-secondary hover:text-primary transition-colors flex items-center gap-2 no-underline">
                    <span class="material-symbols-outlined">account_circle</span>
                    <span class="text-sm font-bold hidden md:block"><?= $_SESSION['user_name'] ?></span>
                </a>
                <a href="/logout" class="p-2 border border-outline/30 rounded text-secondary hover:bg-primary-container hover:text-on-primary-container hover:border-primary-container transition-all">Sair</a>
            <?php else: ?>
                <a href="/login" class="text-secondary hover:text-primary text-sm font-bold uppercase tracking-widest transition-colors no-underline">Despertar</a>
            <?php endif; ?>
        </div>
    </div>
</header>