<?php
    // O UsuarioController já garantiu a sessão e carregou os dados para a variável $escriba
    $nome = htmlspecialchars($escriba['nome_usuario']);
    $email = htmlspecialchars($escriba['email']);
    $dataPacto = date('d/m/Y', strtotime($escriba['created_at']));
?>
<!DOCTYPE html>
<html lang="pt-PT">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Perfil do Escriba - Eversidian</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        /* Importação de fontes para a temática Dark Fantasy */
        @import url('https://fonts.googleapis.com/css2?family=Cinzel:wght@400;700&family=Inter:wght@300;400;600&display=swap');
        
        body { font-family: 'Inter', sans-serif; }
        .cinzel { font-family: 'Cinzel', serif; }
        
        /* Fundo com textura/gradiente subtil */
        .bg-abyss {
            background: radial-gradient(circle at top, #18181b 0%, #09090b 100%);
        }
    </style>
</head>
<body class="min-h-screen bg-abyss text-zinc-300 antialiased flex flex-col">

    <nav class="border-b border-zinc-800/50 bg-zinc-950/80 backdrop-blur-md px-8 py-4 flex justify-between items-center sticky top-0 z-50">
        <div class="text-2xl font-bold cinzel text-zinc-100 tracking-widest drop-shadow-[0_0_8px_rgba(255,255,255,0.1)]">
            <a href="<?= BASE_DIR ?>/campanhas" class="hover:text-red-800 transition-colors duration-300">EVERSIDIAN</a>
        </div>
        <div class="flex gap-6 items-center text-sm font-medium">
            <a href="<?= BASE_DIR ?>/campanhas" class="text-zinc-400 hover:text-zinc-100 transition-colors">O Salão de Campanhas</a>
            <a href="<?= BASE_DIR ?>/logout" class="text-red-900 hover:text-red-700 transition-colors border border-red-900/30 hover:border-red-700 px-4 py-2 rounded-md bg-red-950/20">
                Quebrar Pacto (Sair)
            </a>
        </div>
    </nav>

    <main class="flex-grow flex items-center justify-center p-6">
        <div class="max-w-5xl w-full grid grid-cols-1 md:grid-cols-3 gap-8">
            
            <div class="col-span-1 bg-zinc-900/40 border border-zinc-800/60 rounded-lg p-6 flex flex-col items-center shadow-2xl relative overflow-hidden backdrop-blur-sm">
                <div class="absolute top-0 w-full h-1 bg-gradient-to-r from-transparent via-red-900/50 to-transparent"></div>
                
                <div class="w-32 h-32 rounded-full bg-zinc-950 border border-zinc-800 flex items-center justify-center mb-5 overflow-hidden shadow-[0_0_30px_rgba(0,0,0,0.8)] inset-0">
                    <span class="text-6xl cinzel text-zinc-700"><?= strtoupper(substr($nome, 0, 1)) ?></span>
                </div>
                
                <h2 class="text-2xl font-bold cinzel text-zinc-100 mb-1 text-center"><?= $nome ?></h2>
                <p class="text-sm text-zinc-500 mb-6 border-b border-zinc-800/50 pb-4 w-full text-center">Escriba Iniciado</p>
                
                <div class="w-full text-sm space-y-4">
                    <div class="flex flex-col">
                        <span class="text-xs font-bold text-zinc-600 uppercase tracking-wider mb-1">Selo de Contacto</span>
                        <span class="text-zinc-300 break-all"><?= $email ?></span>
                    </div>
                    <div class="flex flex-col">
                        <span class="text-xs font-bold text-zinc-600 uppercase tracking-wider mb-1">Pacto Forjado em</span>
                        <span class="text-zinc-300"><?= $dataPacto ?></span>
                    </div>
                </div>
            </div>

            <div class="col-span-1 md:col-span-2 bg-zinc-900/40 border border-zinc-800/60 rounded-lg p-8 shadow-2xl backdrop-blur-sm">
                <h2 class="text-2xl cinzel text-zinc-100 mb-6 flex items-center gap-3">
                    <span class="w-8 h-[1px] bg-red-900/50"></span>
                    Reescrever as Escrituras
                </h2>
                
                <?php if (isset($_SESSION['sucesso'])): ?>
                    <div class="bg-green-950/30 border border-green-900/50 text-green-400/90 px-5 py-4 rounded-md mb-8 text-sm">
                        <?= $_SESSION['sucesso']; unset($_SESSION['sucesso']); ?>
                    </div>
                <?php endif; ?>

                <?php if (isset($_SESSION['erro'])): ?>
                    <div class="bg-red-950/30 border border-red-900/50 text-red-400/90 px-5 py-4 rounded-md mb-8 text-sm">
                        <?= $_SESSION['erro']; unset($_SESSION['erro']); ?>
                    </div>
                <?php endif; ?>

                <form action="<?= BASE_DIR ?>/perfil?acao=atualizar" method="POST" class="space-y-6 mt-4">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div class="space-y-2">
                            <label for="nome_usuario" class="block text-xs font-bold text-zinc-500 uppercase tracking-wider">A sua Identidade (Nome)</label>
                            <input type="text" id="nome_usuario" name="nome_usuario" value="<?= $nome ?>" required
                                class="w-full bg-zinc-950/50 border border-zinc-800 rounded px-4 py-3 text-zinc-200 placeholder-zinc-700 focus:outline-none focus:ring-1 focus:ring-red-900/50 focus:border-red-900/50 transition-all">
                        </div>

                        <div class="space-y-2">
                            <label for="email" class="block text-xs font-bold text-zinc-500 uppercase tracking-wider">Novo Selo (E-mail)</label>
                            <input type="email" id="email" name="email" value="<?= $email ?>" required
                                class="w-full bg-zinc-950/50 border border-zinc-800 rounded px-4 py-3 text-zinc-200 placeholder-zinc-700 focus:outline-none focus:ring-1 focus:ring-red-900/50 focus:border-red-900/50 transition-all">
                        </div>
                    </div>

                    <div class="pt-8 mt-6 border-t border-zinc-800/50 flex justify-end">
                        <button type="submit" 
                            class="bg-zinc-800 hover:bg-zinc-700 text-zinc-200 text-sm font-medium py-3 px-8 rounded border border-zinc-700 hover:border-zinc-500 transition-all shadow-lg hover:shadow-[0_0_15px_rgba(255,255,255,0.05)]">
                            Consagrar Alterações
                        </button>
                    </div>
                </form>
            </div>
            
        </div>
    </main>
</body>
</html>