<?php
    // Busca nativa para alimentar a View, já que o fluxo cruza direto no index.php
    require_once __DIR__ . '/../../Model/Pedido.php';
    require_once __DIR__ . '/../../Core/Database.php';
    $db = Database::getInstance();
    $stmt = $db->query("SELECT p.*, u.nome_usuario, u.email FROM pedidos p JOIN usuarios u ON p.id_usuario = u.id ORDER BY p.created_at DESC");
    $pedidos = $stmt->fetchAll();
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title>Transações Comerciais | Eversidian</title>
    <link href="https://fonts.googleapis.com/css2?family=Cinzel:wght@400;700&family=Inter:wght@300;400;600&family=Newsreader:ital,opsz,wght@0,6..72,300..800;1,6..72,300..800&family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet"/>
    <link href="<?= BASE_DIR ?>/Public/Assets/css/style.css" rel="stylesheet"/>
</head>
<body class="bg-surface text-on-surface font-body flex flex-col min-h-screen relative">
    
    <?php include_once __DIR__ . '/../Components/header.php'; ?>

    <main class="flex-1 pt-32 pb-20 px-6 max-w-[80rem] mx-auto w-full relative z-10">
        <div class="mb-8 flex items-center justify-between">
            <div>
                <a href="<?= BASE_DIR ?>/admin" class="text-secondary/50 hover:text-primary text-xs uppercase tracking-[0.2em] no-underline mb-2 flex items-center gap-2 transition-colors">
                    <span class="material-symbols-outlined text-sm">arrow_back</span> Voltar ao Painel
                </a>
                <h1 class="font-headline text-4xl text-on-surface">Registro de <em class="text-primary italic">Oferendas</em></h1>
            </div>
        </div>

        <?php if(isset($_SESSION['sucesso'])): ?>
            <div class="bg-green-900/20 border border-green-500/30 text-green-400 p-4 rounded mb-8 text-sm font-bold tracking-wide shadow-lg">
                <?= $_SESSION['sucesso']; unset($_SESSION['sucesso']); ?>
            </div>
        <?php endif; ?>
        <?php if(isset($_SESSION['erro'])): ?>
            <div class="bg-primary-container/20 border border-primary-container/50 text-primary-container p-4 rounded mb-8 text-sm font-bold tracking-wide shadow-lg">
                <?= $_SESSION['erro']; unset($_SESSION['erro']); ?>
            </div>
        <?php endif; ?>

        <div class="bg-surface-container-low border border-outline-variant/30 rounded p-6 shadow-xl">
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="text-[0.65rem] text-secondary/60 uppercase tracking-[0.2em] border-b border-outline-variant/20">
                            <th class="pb-3 px-4">Protocolo (ID)</th>
                            <th class="pb-3 px-4">Comprador</th>
                            <th class="pb-3 px-4">Total Moedas</th>
                            <th class="pb-3 px-4">Data do Pacto</th>
                            <th class="pb-3 px-4">Alterar Estágio</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if(!empty($pedidos)): ?>
                            <?php foreach($pedidos as $pedido): ?>
                            <tr class="border-b border-outline-variant/10 hover:bg-surface-container transition-colors">
                                <td class="py-5 px-4 text-primary font-mono text-sm font-bold">#<?= str_pad($pedido['id'], 6, '0', STR_PAD_LEFT) ?></td>
                                <td class="py-5 px-4 font-bold text-on-surface">
                                    <?= htmlspecialchars($pedido['nome_usuario']) ?>
                                    <span class="block text-[10px] text-secondary/50 font-normal mt-1"><?= htmlspecialchars($pedido['email']) ?></span>
                                </td>
                                <td class="py-5 px-4 text-sm font-mono text-secondary">R$ <?= number_format($pedido['total'], 2, ',', '.') ?></td>
                                <td class="py-5 px-4 text-sm text-secondary/70"><?= date('d/m/Y H:i', strtotime($pedido['created_at'])) ?></td>
                                <td class="py-5 px-4">
                                    <form action="<?= BASE_DIR ?>/admin/pedidos/atualizar?id=<?= $pedido['id'] ?>" method="POST" class="flex items-center gap-2">
                                        <select name="status" class="bg-surface-container-lowest border border-outline-variant/50 text-[10px] uppercase tracking-wider rounded p-2 text-on-surface focus:border-primary focus:outline-none cursor-pointer">
                                            <option value="pendente" <?= $pedido['status'] === 'pendente' ? 'selected' : '' ?>>Pendente</option>
                                            <option value="pago" <?= $pedido['status'] === 'pago' ? 'selected' : '' ?>>Pago</option>
                                            <option value="enviado" <?= $pedido['status'] === 'enviado' ? 'selected' : '' ?>>Enviado</option>
                                            <option value="finalizado" <?= $pedido['status'] === 'finalizado' ? 'selected' : '' ?>>Finalizado</option>
                                            <option value="cancelado" <?= $pedido['status'] === 'cancelado' ? 'selected' : '' ?>>Cancelado</option>
                                        </select>
                                        <button type="submit" class="p-1.5 bg-surface-bright text-secondary border border-outline/30 rounded hover:bg-primary-container hover:text-on-primary-container hover:border-primary-container transition-colors cursor-pointer" title="Gravar Status">
                                            <span class="material-symbols-outlined text-[16px]">save</span>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="5" class="py-8 text-center text-secondary/50 italic">Nenhuma oferenda transacionada ainda.</td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </main>
    <?php include_once __DIR__ . '/../Components/footer.php'; ?>
</body>
</html>