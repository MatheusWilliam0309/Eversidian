<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title>Auditoria de Escribas | Eversidian</title>
    <link href="https://fonts.googleapis.com/css2?family=Cinzel:wght@400;700&family=Inter:wght@300;400;600&family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet"/>
    <link href="<?= BASE_DIR ?>/Public/Assets/css/style.css" rel="stylesheet"/>
</head>
<body class="bg-surface text-on-surface font-body flex flex-col min-h-screen relative">
    
    <?php include_once __DIR__ . '/../Components/header.php'; ?>

    <!-- max-w-[70rem] força a tabela a ficar compacta e centralizada como na imagem 'Antes' -->
    <main class="flex-1 pt-32 pb-20 px-6 max-w-[70rem] mx-auto w-full relative z-10">
        
        <div class="mb-12 flex items-end justify-between">
            <div>
                <a href="<?= BASE_DIR ?>/admin" class="text-secondary/60 hover:text-primary text-[10px] uppercase tracking-[0.2em] font-bold no-underline mb-4 flex items-center gap-2 transition-colors">
                    <span class="material-symbols-outlined text-sm">arrow_back</span> Voltar ao Painel
                </a>
                <h1 class="font-headline text-4xl text-on-surface tracking-wide">Auditoria de <em class="text-primary italic">Escribas</em></h1>
            </div>
            
            <!-- Botão Forjar Mestre (Agora Laranja - primary) -->
            <details class="relative inline-block text-left group">
                <summary class="list-none cursor-pointer px-4 py-2 border border-primary/50 text-primary hover:bg-primary/10 text-[10px] font-bold uppercase tracking-widest rounded-sm transition-colors flex items-center gap-2">
                    Forjar Novo Mestre
                </summary>
                <div class="absolute right-0 mt-3 w-80 bg-surface-container-high border border-outline-variant/30 rounded-sm shadow-2xl p-6 z-50 text-left">
                    <h4 class="font-headline text-lg text-primary mb-4 border-b border-outline-variant/20 pb-2">Elevar Alma a Mestre</h4>
                    <form action="<?= BASE_DIR ?>/admin/usuarios/novo_admin" method="POST" class="flex flex-col gap-4">
                        <input type="text" name="nome_usuario" placeholder="Nome do Mestre" required class="w-full bg-transparent border-b border-outline-variant/50 text-xs py-2 text-on-surface focus:outline-none focus:border-primary">
                        <input type="email" name="email" placeholder="Selo de Contacto (E-mail)" required class="w-full bg-transparent border-b border-outline-variant/50 text-xs py-2 text-on-surface focus:outline-none focus:border-primary">
                        <input type="password" name="senha" placeholder="Palavra de Poder (Senha)" required class="w-full bg-transparent border-b border-outline-variant/50 text-xs py-2 text-on-surface focus:outline-none focus:border-primary">
                        <button type="submit" class="mt-4 w-full bg-primary text-on-primary text-[10px] uppercase tracking-widest font-bold py-2.5 rounded-sm hover:brightness-110 transition-all">Consagrar</button>
                    </form>
                </div>
            </details>
        </div>

        <?php if(isset($_SESSION['sucesso'])): ?>
            <div class="border border-green-500/30 text-green-400 bg-green-900/10 p-3 rounded-sm mb-8 text-[10px] uppercase tracking-wider font-bold">
                <?= $_SESSION['sucesso']; unset($_SESSION['sucesso']); ?>
            </div>
        <?php endif; ?>
        <?php if(isset($_SESSION['erro'])): ?>
            <div class="border border-primary/40 text-primary bg-primary/10 p-3 rounded-sm mb-8 text-[10px] uppercase tracking-wider font-bold">
                <?= $_SESSION['erro']; unset($_SESSION['erro']); ?>
            </div>
        <?php endif; ?>

        <div class="w-full">
            <table class="w-full text-left">
                <thead>
                    <tr class="text-[0.65rem] text-secondary uppercase tracking-[0.2em] font-bold border-b border-outline-variant/30">
                        <th class="pb-3 px-2 w-1/4">Escriba</th>
                        <th class="pb-3 px-2 text-center">Selo de Contato</th>
                        <th class="pb-3 px-2 text-center">Hierarquia</th>
                        <th class="pb-3 px-2 text-center">Status</th>
                        <th class="pb-3 px-2 text-right">Julgamento</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if(!empty($usuarios)): ?>
                        <?php $contador = 1; foreach($usuarios as $user): ?>
                        <tr class="border-b border-outline-variant/10 hover:bg-surface-container-lowest transition-colors">
                            
                            <td class="py-6 px-2">
                                <span class="font-bold text-on-surface text-sm block mb-1"><?= htmlspecialchars($user['nome_usuario']) ?></span>
                                <span class="text-[9px] text-secondary/50 font-bold tracking-wider">
                                    ID: #<?= $contador ?> <span class="mx-1">|</span> Pacto: <?= date('d/m/Y', strtotime($user['created_at'])) ?>
                                </span>
                            </td>
                            
                            <td class="py-6 px-2 text-center text-sm text-secondary/70">
                                <?= htmlspecialchars($user['email']) ?>
                            </td>
                            
                            <td class="py-6 px-2 text-center">
                                <span class="inline-block px-3 py-1 border border-secondary/50 text-secondary text-[10px] uppercase tracking-widest font-bold rounded-sm">
                                    <?= htmlspecialchars($user['role']) ?>
                                </span>
                            </td>
                            
                            <td class="py-6 px-2 text-center">
                                <?php if($user['status'] === 'ativo'): ?>
                                    <div class="flex items-center justify-center gap-1.5 text-on-surface">
                                        <span class="material-symbols-outlined text-[16px]">verified</span>
                                        <span class="font-bold text-[10px] uppercase tracking-widest">Ativo</span>
                                    </div>
                                <?php else: ?>
                                    <div class="flex flex-col items-center justify-center">
                                        <div class="flex items-center justify-center gap-1.5 text-primary mb-1">
                                            <span class="material-symbols-outlined text-[16px]">block</span>
                                            <span class="font-bold text-[10px] uppercase tracking-widest">Exilado</span>
                                        </div>
                                        <span class="text-[9px] text-secondary/60 font-bold tracking-widest">
                                            Liberação: <?= !empty($user['banido_ate']) ? date('d/m/Y H:i', strtotime($user['banido_ate'])) : 'Para Sempre' ?>
                                        </span>
                                    </div>
                                <?php endif; ?>
                            </td>
                            
                            <td class="py-6 px-2 text-right">
                                <div class="flex items-center justify-end gap-3">
                                    
                                    <?php if($user['status'] === 'ativo' && $user['role'] !== 'gmAdmin'): ?>
                                        <!-- Botão Exilar (Laranja - primary) -->
                                        <details class="relative inline-block text-left group">
                                            <summary class="list-none cursor-pointer px-3 py-1 border border-primary/50 text-primary hover:bg-primary/10 text-[9px] font-bold uppercase tracking-widest rounded-sm transition-colors">
                                                Exilar
                                            </summary>
                                            <div class="absolute right-0 mt-2 w-56 bg-surface-container-high border border-outline-variant/30 rounded-sm shadow-2xl p-4 z-50 text-left">
                                                <h4 class="text-[10px] text-primary mb-3 uppercase tracking-[0.2em] font-bold border-b border-outline-variant/20 pb-2">Sentenciar Alma</h4>
                                                <form action="<?= BASE_DIR ?>/admin/usuarios/banir" method="POST" class="flex flex-col gap-3">
                                                    <input type="hidden" name="id_usuario" value="<?= $user['id'] ?>">
                                                    <select name="tipo_ban" required class="w-full bg-surface-container-lowest border-b border-outline-variant/50 text-[10px] uppercase tracking-wider py-2 text-on-surface focus:outline-none focus:border-primary">
                                                        <option value="temporario">Exílio (Dias)</option>
                                                        <option value="permanente">Ban Eterno</option>
                                                    </select>
                                                    <input type="number" name="dias" placeholder="Dias (Se temp.)" min="1" class="w-full bg-transparent border-b border-outline-variant/50 text-[10px] py-2 text-on-surface focus:outline-none focus:border-primary">
                                                    <button type="submit" class="mt-2 w-full bg-primary text-on-primary text-[9px] font-bold uppercase tracking-[0.2em] py-2 rounded-sm hover:brightness-110 transition-colors">Executar</button>
                                                </form>
                                            </div>
                                        </details>
                                    <?php elseif($user['status'] === 'banido' || $user['status'] === 'exilado'): ?>
                                        <!-- Botão Perdoar (Laranja - primary) -->
                                        <form action="<?= BASE_DIR ?>/admin/usuarios/revogar" method="POST">
                                            <input type="hidden" name="id_usuario" value="<?= $user['id'] ?>">
                                            <button type="submit" class="px-3 py-1 border border-primary/50 text-primary hover:bg-primary/10 text-[9px] font-bold uppercase tracking-widest rounded-sm transition-colors cursor-pointer">
                                                Perdoar
                                            </button>
                                        </form>
                                    <?php endif; ?>

                                    <!-- Botão Excluir (Laranja - primary) -->
                                    <?php if($user['id'] !== $_SESSION['user_id']): ?>
                                        <form action="<?= BASE_DIR ?>/admin/usuarios/excluir" method="POST" onsubmit="return confirm('ATENÇÃO: Obliterar esta alma apagá-la-á eternamente. Tens a certeza?');">
                                            <input type="hidden" name="id_usuario" value="<?= $user['id'] ?>">
                                            <button type="submit" class="text-primary/70 hover:text-primary transition-colors cursor-pointer flex items-center justify-center bg-transparent border-none">
                                                <span class="material-symbols-outlined text-[18px]">delete</span>
                                            </button>
                                        </form>
                                    <?php endif; ?>

                                </div>
                            </td>
                        </tr>
                        <?php $contador++; endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="5" class="py-12 text-center text-secondary/50 text-[10px] uppercase tracking-widest font-bold">Nenhum escriba foi forjado ainda.</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </main>
    <?php include_once __DIR__ . '/../Components/footer.php'; ?>
</body>
</html>