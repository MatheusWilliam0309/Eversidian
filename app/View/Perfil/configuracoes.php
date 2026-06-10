<?php $usuarioAtivo = $_SESSION; ?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title>Configurações | Eversidian</title>
    <link href="https://fonts.googleapis.com/css2?family=Cinzel:wght@400;500;600;700&family=Inter:wght@300;400;600;700&family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet"/>
    <link href="<?= BASE_DIR ?>/Public/Assets/css/style.css" rel="stylesheet"/>
    <style>
        .sharp-border { border: 1px solid rgba(255, 255, 255, 0.2); }
    </style>
</head>
<body class="bg-[#0f0f0f] text-[#e5e2e1] font-body flex flex-col min-h-screen">
    
    <?php include_once __DIR__ . '/../Components/header.php'; ?>

    <main class="flex-1 flex items-start justify-center pt-32 pb-20 px-6 max-w-[50rem] mx-auto w-full">
        
        <div class="sharp-border bg-transparent p-10 w-full shadow-2xl">
            <div class="mb-8 border-b border-[rgba(255,255,255,0.1)] pb-6 flex items-center gap-4">
                <span class="material-symbols-outlined text-3xl text-white">settings</span>
                <h2 class="font-cinzel text-2xl font-bold uppercase tracking-widest text-white">Configurações</h2>
            </div>

            <?php if(isset($_SESSION['sucesso'])): ?>
                <div class="sharp-border bg-[#152515] text-[#8aca8a] p-4 mb-6 text-xs uppercase tracking-wider font-bold">
                    <?= $_SESSION['sucesso']; unset($_SESSION['sucesso']); ?>
                </div>
            <?php endif; ?>
            <?php if(isset($_SESSION['erro'])): ?>
                <div class="sharp-border bg-[#3a1515] text-[#ca8a8a] p-4 mb-6 text-xs uppercase tracking-wider font-bold">
                    <?= $_SESSION['erro']; unset($_SESSION['erro']); ?>
                </div>
            <?php endif; ?>

            <form action="<?= BASE_DIR ?>/configuracoes/atualizar" method="POST" enctype="multipart/form-data" class="flex flex-col gap-6">
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label class="block text-[0.65rem] text-[#b0b0b0] uppercase tracking-[0.15em] font-bold mb-2">A Sua Identidade (Nome)</label>
                        <input type="text" name="nome_usuario" value="<?= htmlspecialchars($usuarioAtivo['user_name']) ?>" class="w-full bg-[#111] sharp-border py-3 px-4 text-sm text-white focus:outline-none focus:border-[#e5e2e1] transition-colors">
                    </div>
                    <div>
                        <label class="block text-[0.65rem] text-[#b0b0b0] uppercase tracking-[0.15em] font-bold mb-2">Selo (E-mail)</label>
                        <input type="email" name="email" value="<?= htmlspecialchars($usuarioAtivo['user_email'] ?? '') ?>" class="w-full bg-[#111] sharp-border py-3 px-4 text-sm text-white focus:outline-none focus:border-[#e5e2e1] transition-colors">
                    </div>
                </div>

                <div>
                    <label class="block text-[0.65rem] text-[#b0b0b0] uppercase tracking-[0.15em] font-bold mb-2">Renovar Selo Visual (Foto)</label>
                    <input type="file" name="foto_perfil" accept="image/png, image/jpeg, image/webp" class="w-full bg-[#111] sharp-border p-2 text-xs text-[#8a8a8a] file:mr-4 file:py-2 file:px-4 file:border-0 file:text-xs file:font-bold file:uppercase file:tracking-wider file:bg-[#222] file:text-white hover:file:bg-[#333] transition-colors cursor-pointer">
                </div>

                <div class="mt-4 pt-6 border-t border-[rgba(255,255,255,0.1)]">
                    <label class="block text-[0.65rem] text-[#b0b0b0] uppercase tracking-[0.15em] font-bold mb-2 text-primary">Forjar Nova Senha (Opcional)</label>
                    <input type="password" name="nova_senha" placeholder="Deixe em branco para não alterar..." class="w-full bg-[#111] sharp-border py-3 px-4 text-sm text-white focus:outline-none focus:border-[#e5e2e1] transition-colors">
                </div>

                <div class="flex justify-end pt-6 mt-2 border-t border-[rgba(255,255,255,0.1)]">
                    <button type="submit" class="sharp-border bg-[#151515] hover:bg-[#e5e2e1] hover:text-[#0f0f0f] text-white px-8 py-3 text-xs uppercase tracking-widest font-bold transition-colors">
                        Consagrar Alterações
                    </button>
                </div>
            </form>
        </div>
    </main>
    <?php include_once __DIR__ . '/../Components/footer.php'; ?>
</body>
</html>