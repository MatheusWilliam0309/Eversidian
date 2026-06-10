<?php 
    // Verifica se a alma em sessão tem privilégios de Mestre do Vácuo
    $isAdmin = isset($_SESSION['user_role']) && in_array($_SESSION['user_role'], ['gmAdmin', 'moderador']); 
?>
<header class="fixed top-0 w-full bg-surface/85 backdrop-blur-md border-b border-outline-variant/30 z-50 transition-all duration-300">
    <div class="max-w-[90rem] mx-auto px-6 h-20 flex items-center justify-between">
        <a href="<?= BASE_DIR ?>/" class="flex items-center gap-3 group no-underline">
            <span class="font-cinzel text-2xl text-on-surface tracking-wide">EVERSIDIAN</span>
        </a>
        
        <nav class="hidden lg:flex items-center gap-8">
            <a href="<?= BASE_DIR ?>/campanhas" class="text-secondary/80 hover:text-primary text-sm font-bold uppercase tracking-widest transition-colors no-underline">Campanhas</a>
            <a href="<?= BASE_DIR ?>/cronicas" class="text-secondary/80 hover:text-primary text-sm font-bold uppercase tracking-widest transition-colors no-underline">Crônicas</a>
            
            <?php if (!$isAdmin): ?>
                <a href="<?= BASE_DIR ?>/loja" class="text-secondary/80 hover:text-primary text-sm font-bold uppercase tracking-widest transition-colors no-underline">Arsenal</a>
            <?php endif; ?>
        </nav>

        <div class="flex items-center gap-4">
            <?php if (isset($_SESSION['user_id'])): ?>
                
                <div class="relative">
                    <button id="user-menu-btn" class="flex items-center gap-2 text-secondary hover:text-primary transition-colors focus:outline-none cursor-pointer bg-transparent border-none py-2">
                        
                        <!-- VERIFICAÇÃO DA FOTO DE PERFIL (BLINDADA) -->
                        <?php if (isset($_SESSION['user_foto_perfil']) && !empty($_SESSION['user_foto_perfil'])): ?>
                            <img src="<?= BASE_DIR ?>/Public/Uploads/<?= $_SESSION['user_foto_perfil'] ?>" alt="Perfil" 
                                 class="w-8 h-8 rounded-full object-cover border border-[#2a2a2a] shadow-sm shrink-0" 
                                 style="width: 6vh; height: 6vh; min-width: 6vh; min-height: 6vh;">
                        <?php else: ?>
                            <span class="material-symbols-outlined">account_circle</span>
                        <?php endif; ?>

                        <span class="text-sm font-bold hidden md:block"><?= htmlspecialchars($_SESSION['user_name']) ?></span>
                        <span id="user-menu-icon" class="material-symbols-outlined text-sm transition-transform duration-300">expand_more</span>
                    </button>

                    <div id="user-menu-dropdown" class="hidden absolute right-0 top-full mt-2 w-56 bg-surface-container-high border border-outline-variant/30 rounded shadow-[0_16px_40px_rgba(0,0,0,0.6)] z-50 flex flex-col overflow-hidden origin-top-right transition-all">
                        
                        <?php if ($isAdmin): ?>
                            <a href="<?= BASE_DIR ?>/admin/" class="px-5 py-4 text-[0.65rem] font-bold uppercase tracking-[0.15em] text-primary-container border-b border-outline-variant/20 hover:bg-primary-container/10 transition-colors no-underline flex items-center gap-3">
                                <span class="material-symbols-outlined text-base">admin_panel_settings</span> Painel do Mestre
                            </a>
                        <?php endif; ?>
                        
                        <a href="<?= BASE_DIR ?>/perfil" class="px-5 py-4 text-[0.65rem] font-bold uppercase tracking-[0.15em] text-secondary border-b border-outline-variant/20 hover:bg-surface-bright transition-colors no-underline flex items-center gap-3">
                            <span class="material-symbols-outlined text-base">person</span> Perfil
                        </a>
                        
                        <a href="<?= BASE_DIR ?>/configuracoes" class="px-5 py-4 text-[0.65rem] font-bold uppercase tracking-[0.15em] text-secondary border-b border-outline-variant/20 hover:bg-surface-bright transition-colors no-underline flex items-center gap-3">
                            <span class="material-symbols-outlined text-base">settings</span> Configurações
                        </a>
                        
                        <a href="<?= BASE_DIR ?>/logout" class="px-5 py-4 text-[0.65rem] font-bold uppercase tracking-[0.15em] text-red-400 hover:bg-red-900/20 transition-colors no-underline flex items-center gap-3">
                            <span class="material-symbols-outlined text-base">logout</span> Despertar (Sair)
                        </a>
                    </div>
                </div>

            <?php else: ?>
                <a href="<?= BASE_DIR ?>/login" class="text-secondary hover:text-primary text-sm font-bold uppercase tracking-widest transition-colors no-underline">Despertar</a>
            <?php endif; ?>
        </div>
    </div>
</header>

<script>
    // Lógica para abrir/fechar o dropbox ao clicar
    document.addEventListener('DOMContentLoaded', function() {
        const btn = document.getElementById('user-menu-btn');
        const menu = document.getElementById('user-menu-dropdown');
        const icon = document.getElementById('user-menu-icon');

        if (btn && menu) {
            btn.addEventListener('click', function(e) {
                e.stopPropagation(); // Evita que o clique feche imediatamente
                menu.classList.toggle('hidden');
                icon.classList.toggle('rotate-180');
            });

            // Fecha o menu se o utilizador clicar em qualquer outro lugar da página
            document.addEventListener('click', function(e) {
                if (!btn.contains(e.target) && !menu.contains(e.target)) {
                    menu.classList.add('hidden');
                    icon.classList.remove('rotate-180');
                }
            });
        }
    });
</script>