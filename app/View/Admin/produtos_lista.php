<?php 
    // Busca as categorias disponíveis para alimentar a Forja
    include_once __DIR__ . '/../../Model/Categoria.php';
    $catModel = new Categoria();
    $categorias = $catModel->findAll();
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title>Gerenciamento de Artefatos | Eversidian</title>
    <link href="https://fonts.googleapis.com/css2?family=Cinzel:wght@400;700&family=Inter:wght@300;400;600&family=Newsreader:ital,opsz,wght@0,6..72,300..800;1,6..72,300..800&family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet"/>
    <link href="<?= BASE_DIR ?>/Public/Assets/css/style.css" rel="stylesheet"/>
</head>
<body class="bg-surface text-on-surface font-body flex flex-col min-h-screen relative">
    
    <?php include_once __DIR__ . '/../Components/header.php'; ?>

    <main class="flex-1 pt-32 pb-20 px-6 max-w-[90rem] mx-auto w-full relative z-10">
        <div class="mb-8 flex items-center justify-between">
            <div>
                <a href="<?= BASE_DIR ?>/admin" class="text-secondary/50 hover:text-primary text-xs uppercase tracking-[0.2em] no-underline mb-2 flex items-center gap-2 transition-colors">
                    <span class="material-symbols-outlined text-sm">arrow_back</span> Voltar ao Painel
                </a>
                <h1 class="font-headline text-4xl text-on-surface">Cofre de <em class="text-primary italic">Artefatos</em></h1>
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

        <div class="grid grid-cols-1 lg:grid-cols-12 gap-8">
            
            <div class="lg:col-span-4 bg-surface-container-low border border-outline-variant/30 rounded p-6 shadow-xl relative overflow-hidden h-fit">
                <div class="absolute -top-10 -right-10 w-20 h-20 bg-primary/10 rotate-45 pointer-events-none"></div>
                <h2 class="font-headline text-2xl text-secondary mb-6 border-b border-outline-variant/20 pb-4 flex items-center gap-2">
                    <span class="material-symbols-outlined text-primary">local_fire_department</span> A Forja
                </h2>
                
                <form action="<?= BASE_DIR ?>/admin/produtos/novo" method="POST" enctype="multipart/form-data" class="flex flex-col gap-4">
                    <div>
                        <label class="block text-[0.65rem] font-bold text-secondary/70 uppercase tracking-[0.15em] mb-1">Nome do Artefato</label>
                        <input type="text" name="nome" required class="w-full bg-surface-container-lowest border border-outline-variant/50 rounded p-2.5 text-sm focus:border-primary focus:outline-none transition-colors">
                    </div>

                    <div>
                        <label class="block text-[0.65rem] font-bold text-secondary/70 uppercase tracking-[0.15em] mb-1">Selo Visual (Imagem) *</label>
                        <input type="file" name="imagem" accept="image/png, image/jpeg, image/webp" required class="w-full bg-surface-container-lowest border border-outline-variant/50 rounded p-2 text-sm text-secondary/70 file:mr-4 file:py-2 file:px-4 file:rounded file:border-0 file:text-xs file:font-bold file:uppercase file:tracking-wider file:bg-primary-container/20 file:text-primary-container hover:file:bg-primary-container/30 transition-colors cursor-pointer">
                    </div>

                    <!-- CAMPO CATEGORIA COM LORE DINÂMICA -->
                    <div>
                        <label class="block text-[0.65rem] font-bold text-secondary/70 uppercase tracking-[0.15em] mb-1">Categoria do Artefato</label>
                        <select name="id_categoria" id="seletor_categoria" required class="w-full bg-surface-container-lowest border border-outline-variant/50 rounded p-2.5 text-sm focus:border-primary focus:outline-none transition-colors">
                            <option value="" data-desc="">Selecione o cofre de destino...</option>
                            <?php foreach($categorias as $cat): ?>
                                <option value="<?= $cat['id'] ?>" data-desc="<?= htmlspecialchars($cat['descricao']) ?>">
                                    <?= htmlspecialchars($cat['nome']) ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                        
                        <!-- Caixa de Revelação da Descrição (Oculta por padrão) -->
                        <div id="caixa_descricao_categoria" class="hidden mt-2 p-3 border-l-2 border-[#d6c692]/50 bg-[#d6c692]/5 rounded-r-sm transition-all">
                            <p id="texto_descricao_categoria" class="text-[9px] text-[0.75rem] font-bold italic leading-relaxed tracking-wide"></p>
                        </div>
                    </div>

                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label class="block text-[0.65rem] font-bold text-secondary/70 uppercase tracking-[0.15em] mb-1">Natureza (Tipo)</label>
                            <select name="tipo" required class="w-full bg-surface-container-lowest border border-outline-variant/50 rounded p-2.5 text-sm focus:border-primary focus:outline-none transition-colors text-primary">
                                <option value="físico">Físico</option>
                                <option value="virtual">Virtual</option>
                            </select>
                        </div>
                        <div>
                            <label class="block text-[0.65rem] font-bold text-secondary/70 uppercase tracking-[0.15em] mb-1">Estoque Físico</label>
                            <input type="number" name="estoque" value="0" min="0" class="w-full bg-surface-container-lowest border border-outline-variant/50 rounded p-2.5 text-sm focus:border-primary focus:outline-none transition-colors">
                        </div>
                    </div>

                    <div>
                        <label class="block text-[0.65rem] font-bold text-secondary/70 uppercase tracking-[0.15em] mb-1">Valor (Moedas)</label>
                        <input type="number" step="0.01" name="preco" required class="w-full bg-surface-container-lowest border border-outline-variant/50 rounded p-2.5 text-sm focus:border-primary focus:outline-none transition-colors font-mono">
                    </div>

                    <div>
                        <label class="block text-[0.65rem] font-bold text-secondary/70 uppercase tracking-[0.15em] mb-1">Poder / Descrição</label>
                        <textarea name="descricao" rows="3" class="w-full bg-surface-container-lowest border border-outline-variant/50 rounded p-2.5 text-sm focus:border-primary focus:outline-none transition-colors resize-none"></textarea>
                    </div>

                    <button type="submit" class="mt-4 w-full py-3 bg-primary-container text-on-primary-container font-bold text-[0.8rem] uppercase tracking-wider rounded shadow-lg hover:brightness-110 transition-all">
                        Forjar Artefato
                    </button>
                </form>
            </div>

            <div class="lg:col-span-8 bg-surface-container-low border border-outline-variant/30 rounded p-6 shadow-xl">
                <h2 class="font-headline text-2xl text-secondary mb-6 border-b border-outline-variant/20 pb-4">Inventário Existente</h2>
                
                <div class="overflow-x-auto">
                    <table class="w-full text-left border-collapse">
                        <thead>
                            <tr class="text-[0.65rem] text-secondary/60 uppercase tracking-[0.2em] border-b border-outline-variant/20">
                                <th class="pb-3 px-2">ID</th>
                                <th class="pb-3 px-2">Artefato</th>
                                <th class="pb-3 px-2">Natureza</th>
                                <th class="pb-3 px-2">Valor</th>
                                <th class="pb-3 px-2">Estoque</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if(!empty($produtos)): ?>
                                <?php foreach($produtos as $prod): ?>
                                <tr class="border-b border-outline-variant/10 hover:bg-surface-container transition-colors group">
                                    <td class="py-4 px-2 text-secondary/40 text-sm font-mono">#<?= $prod['id'] ?></td>
                                    <td class="py-4 px-2 font-bold text-on-surface"><?= htmlspecialchars($prod['nome']) ?></td>
                                    <td class="py-4 px-2">
                                        <span class="px-2 py-1 bg-surface-bright text-[10px] uppercase tracking-wider rounded border border-outline/20 text-secondary">
                                            <?= htmlspecialchars($prod['tipo']) ?>
                                        </span>
                                    </td>
                                    <td class="py-4 px-2 text-primary font-mono text-sm">R$ <?= number_format($prod['preco'], 2, ',', '.') ?></td>
                                    <td class="py-4 px-2 text-sm <?= $prod['estoque'] <= 0 && strtolower($prod['tipo']) === 'físico' ? 'text-primary-container' : 'text-on-surface' ?>">
                                        <?= strtolower($prod['tipo']) === 'virtual' ? '∞' : $prod['estoque'] ?>
                                    </td>
                                </tr>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <tr>
                                    <td colspan="5" class="py-8 text-center text-secondary/50 italic">O cofre está vazio.</td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </main>
    <?php include_once __DIR__ . '/../Components/footer.php'; ?>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const seletor = document.getElementById('seletor_categoria');
            const caixaDescricao = document.getElementById('caixa_descricao_categoria');
            const textoDescricao = document.getElementById('texto_descricao_categoria');

            if (seletor) {
                seletor.addEventListener('change', function() {
                    // Pega a opção que o Admin acabou de clicar
                    const opcaoSelecionada = this.options[this.selectedIndex];
                    // Puxa a descrição que guardámos no data-desc
                    const descricao = opcaoSelecionada.getAttribute('data-desc');

                    if (descricao && descricao.trim() !== '') {
                        textoDescricao.textContent = descricao;
                        caixaDescricao.classList.remove('hidden');
                    } else {
                        caixaDescricao.classList.add('hidden');
                        textoDescricao.textContent = '';
                    }
                });
            }
        });
    </script>
</body>
</html>