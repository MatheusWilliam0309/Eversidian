<?php
    $usuarioAtivo = $_SESSION;
    $iniciais = strtoupper(substr($usuarioAtivo['user_name'], 0, 1));
    $fotoPerfil = isset($usuarioAtivo['user_foto_perfil']) && $usuarioAtivo['user_foto_perfil'] ? BASE_DIR . '/Public/Uploads/' . $usuarioAtivo['user_foto_perfil'] : null;
    $isAdmin = isset($usuarioAtivo['user_role']) && in_array($usuarioAtivo['user_role'], ['gmAdmin', 'moderador']);
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title>Minha Conta | Eversidian</title>
    <link href="https://fonts.googleapis.com/css2?family=Cinzel:wght@400;500;600;700&family=Inter:wght@300;400;600;700&family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet"/>
    <link href="<?= BASE_DIR ?>/Public/Assets/css/style.css" rel="stylesheet"/>
    <style>
        .sharp-border { border: 1px solid rgba(255, 255, 255, 0.2); }
        .sharp-divider { border-top: 1px solid rgba(255, 255, 255, 0.2); }
    </style>
</head>
<body class="bg-[#0f0f0f] text-[#e5e2e1] font-body flex flex-col min-h-screen">
    
    <?php include_once __DIR__ . '/../Components/header.php'; ?>

    <main class="flex-1 flex items-start justify-center pt-32 pb-20 px-6 max-w-[75rem] mx-auto w-full">
        <div class="grid grid-cols-1 md:grid-cols-12 gap-6 w-full">
            
            <!-- COLUNA ESQUERDA: CARD DO PERFIL (Para Todos) -->
            <div class="md:col-span-4 sharp-border bg-transparent p-10 flex flex-col items-center text-center h-fit">
                <!-- Avatar / Ícone (BLINDADO) -->
                <div class="w-40 h-40 sharp-border rounded-md flex items-center justify-center mb-6 overflow-hidden shrink-0 mx-auto" 
                     style="width: 20vh; height: 20vh; min-height: 20vh;">
                    <?php if($fotoPerfil): ?>
                        <img src="<?= $fotoPerfil ?>" alt="Foto de Perfil" class="w-full h-full object-cover">
                    <?php else: ?>
                        <span class="font-cinzel text-5xl text-white"><?= $iniciais ?></span>
                    <?php endif; ?>
                </div>

                <h2 class="font-cinzel text-2xl font-bold tracking-widest text-white mb-2 uppercase"><?= htmlspecialchars($usuarioAtivo['user_name']) ?></h2>
                <p class="text-[0.65rem] text-[#b0b0b0] uppercase tracking-[0.15em] font-bold">
                    <?= $isAdmin ? 'Mestre do Vácuo' : 'Escriba Iniciado' ?>
                </p>
                
                <div class="sharp-divider w-full my-8"></div>
                
                <div class="w-full text-center">
                    <div class="mb-6">
                        <span class="block text-xs text-white uppercase tracking-[0.2em] font-bold mb-2">Selo de Contato</span>
                        <span class="text-sm font-semibold text-[#b0b0b0]"><?= htmlspecialchars($usuarioAtivo['user_email'] ?? 'Oculto') ?></span>
                    </div>
                    <div>
                        <span class="block text-xs text-white uppercase tracking-[0.2em] font-bold mb-2">Pacto Forjado Em</span>
                        <span class="text-sm font-semibold text-[#b0b0b0]"><?= date('d/m/Y', strtotime($usuarioAtivo['created_at'] ?? 'now')) ?></span>
                    </div>
                </div>
            </div>

            <!-- COLUNA DIREITA -->
            <?php if($isAdmin): ?>
                <!-- Visão do Admin -->
                <div class="md:col-span-8 sharp-border bg-transparent p-10 flex flex-col items-center justify-center h-full min-h-[400px]">
                    <span class="material-symbols-outlined text-[4rem] text-[#333] mb-6">admin_panel_settings</span>
                    <h3 class="font-cinzel text-2xl text-white mb-4 uppercase tracking-widest">Domínio de Mestre</h3>
                    <p class="text-[#b0b0b0] text-sm text-center max-w-md mb-8 leading-relaxed">As questões comerciais mortais não vos afetam. Volte ao seu plano administrativo para julgar os escribas e forjar novos artefatos.</p>
                    <a href="<?= BASE_DIR ?>/admin" class="sharp-border bg-transparent hover:bg-[#111] text-[#e5e2e1] px-8 py-3 text-xs uppercase tracking-[0.2em] font-bold transition-colors no-underline">
                        Acessar Painel de Controle
                    </a>
                </div>
            <?php else: ?>
                <!-- Visão E-Commerce do Jogador Normal (Igual à versão anterior) -->
                <div class="md:col-span-8 flex flex-col gap-6">
                    <!-- Bloco 1: Visão Geral -->
                    <div class="sharp-border bg-transparent p-6 flex items-center justify-between">
                        <a href="#" class="flex-1 flex flex-col items-center gap-3 text-[#b0b0b0] hover:text-white transition-colors no-underline group"><span class="material-symbols-outlined text-3xl group-hover:-translate-y-1 transition-transform">favorite</span><span class="text-[0.65rem] uppercase tracking-widest font-bold">Lista de Desejos</span></a>
                        <a href="#" class="flex-1 flex flex-col items-center gap-3 text-[#b0b0b0] hover:text-white transition-colors no-underline group border-l border-[rgba(255,255,255,0.1)]"><span class="material-symbols-outlined text-3xl group-hover:-translate-y-1 transition-transform">menu_book</span><span class="text-[0.65rem] uppercase tracking-widest font-bold">Cofre Digital</span></a>
                        <a href="#" class="flex-1 flex flex-col items-center gap-3 text-[#b0b0b0] hover:text-white transition-colors no-underline group border-l border-[rgba(255,255,255,0.1)]"><span class="material-symbols-outlined text-3xl group-hover:-translate-y-1 transition-transform">local_activity</span><span class="text-[0.65rem] uppercase tracking-widest font-bold">Selos (Cupons)</span></a>
                    </div>
                    <!-- Bloco 2: Rastreador de Oferendas (Pedidos) -->
                    <div class="sharp-border bg-transparent p-8">
                        <div class="flex items-center justify-between mb-8">
                            <h3 class="font-cinzel text-xl text-white">Minhas Oferendas (Pedidos)</h3>
                        </div>
                        <div class="flex items-center justify-between px-4">
                            <div class="flex flex-col items-center gap-3 text-center cursor-pointer group"><span class="material-symbols-outlined text-4xl text-[#7a7a7a] group-hover:text-white">account_balance_wallet</span><span class="text-[0.60rem] uppercase tracking-widest text-[#b0b0b0] group-hover:text-white">Aguard. Pagto</span></div><span class="material-symbols-outlined text-[#333]">arrow_right_alt</span>
                            <div class="flex flex-col items-center gap-3 text-center cursor-pointer group"><span class="material-symbols-outlined text-4xl text-[#7a7a7a] group-hover:text-white">inventory_2</span><span class="text-[0.60rem] uppercase tracking-widest text-[#b0b0b0] group-hover:text-white">Preparando</span></div><span class="material-symbols-outlined text-[#333]">arrow_right_alt</span>
                            <div class="flex flex-col items-center gap-3 text-center cursor-pointer group"><span class="material-symbols-outlined text-4xl text-[#7a7a7a] group-hover:text-white">local_shipping</span><span class="text-[0.60rem] uppercase tracking-widest text-[#b0b0b0] group-hover:text-white">Enviado</span></div><span class="material-symbols-outlined text-[#333]">arrow_right_alt</span>
                            <div class="flex flex-col items-center gap-3 text-center cursor-pointer group"><span class="material-symbols-outlined text-4xl text-[#7a7a7a] group-hover:text-white">task_alt</span><span class="text-[0.60rem] uppercase tracking-widest text-[#b0b0b0] group-hover:text-white">Avaliação</span></div>
                        </div>
                    </div>
                    <!-- Bloco 3: Navegação -->
                    <div class="sharp-border bg-transparent flex flex-col">
                        <a href="#" class="flex items-center justify-between p-6 hover:bg-[#151515] transition-colors no-underline group border-b border-[rgba(255,255,255,0.1)]"><div class="flex items-center gap-4"><span class="material-symbols-outlined text-[#7a7a7a] group-hover:text-white">location_on</span><span class="text-xs uppercase tracking-widest text-[#e5e2e1] font-bold">Endereços de Entrega</span></div><span class="material-symbols-outlined text-[#555] group-hover:text-white">chevron_right</span></a>
                        <a href="#" class="flex items-center justify-between p-6 hover:bg-[#151515] transition-colors no-underline group"><div class="flex items-center gap-4"><span class="material-symbols-outlined text-[#7a7a7a] group-hover:text-white">credit_card</span><span class="text-xs uppercase tracking-widest text-[#e5e2e1] font-bold">Cartões e Pagamentos</span></div><span class="material-symbols-outlined text-[#555] group-hover:text-white">chevron_right</span></a>
                    </div>
                </div>
            <?php endif; ?>

        </div>
    </main>
    <?php include_once __DIR__ . '/../Components/footer.php'; ?>
</body>
</html>