<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="utf-8"/>
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <title>Forjar Destino | Eversidian</title>
    <link href="https://fonts.googleapis.com/css2?family=Newsreader:ital,opsz,wght@0,6..72,300..800;1,6..72,300..800&family=Manrope:wght@300..700&family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet"/>
    <link href="./Public/Assets/css/style.css" rel="stylesheet"/>
</head>
<body class="bg-surface text-on-surface font-body overflow-x-hidden flex flex-col min-h-screen relative">
    
    <div id="particles" class="absolute inset-0 z-0 pointer-events-none overflow-hidden opacity-40"></div>

    <?php include_once __DIR__ . '/../Components/header.php'; ?>

    <main class="flex-1 flex items-center justify-center pt-32 pb-20 px-6 relative z-10">
        <div class="w-full max-w-md bg-surface-container-low border border-outline-variant/30 rounded shadow-[0_16px_40px_rgba(0,0,0,0.6)] p-10 relative overflow-hidden">
            
            <div class="absolute -top-12 -right-12 w-24 h-24 bg-primary-container/10 rotate-45 pointer-events-none"></div>

            <div class="text-center mb-10">
                <span class="material-symbols-outlined text-primary text-5xl mb-4">edit_document</span>
                <h1 class="font-headline text-4xl mb-2">Forjar <em class="text-primary italic">Pacto</em></h1>
                <p class="text-secondary/60 text-sm font-light">Sua alma está prestes a entrar em Eversidian.</p>
            </div>

            <?php if(isset($_SESSION['erro'])): ?>
                <div class="bg-primary-container/10 border border-primary-container/50 text-primary-container p-4 rounded mb-6 text-sm text-center font-semibold">
                    <?= $_SESSION['erro']; unset($_SESSION['erro']); ?>
                </div>
            <?php endif; ?>

            <form action="/cadastro-processar" method="POST" class="flex flex-col gap-5">
                
                <div>
                    <label for="nome" class="block text-[0.65rem] font-bold text-secondary/70 uppercase tracking-[0.15em] mb-2">Nome de Escriba</label>
                    <div class="relative">
                        <span class="material-symbols-outlined absolute left-3 top-1/2 -translate-y-1/2 text-outline/50 text-xl pointer-events-none">person</span>
                        <input type="text" id="nome" name="nome_usuario" required placeholder="Ex: Gandalf, O Cinzento" 
                               class="w-full bg-surface-container-lowest border border-outline-variant/50 rounded py-3 pl-10 pr-4 text-on-surface focus:outline-none focus:border-primary transition-colors placeholder:text-outline/30">
                    </div>
                </div>

                <div>
                    <label for="email" class="block text-[0.65rem] font-bold text-secondary/70 uppercase tracking-[0.15em] mb-2">Selo de Contacto (E-mail)</label>
                    <div class="relative">
                        <span class="material-symbols-outlined absolute left-3 top-1/2 -translate-y-1/2 text-outline/50 text-xl pointer-events-none">mail</span>
                        <input type="email" id="email" name="email" required placeholder="seu@email.com" 
                               class="w-full bg-surface-container-lowest border border-outline-variant/50 rounded py-3 pl-10 pr-4 text-on-surface focus:outline-none focus:border-primary transition-colors placeholder:text-outline/30">
                    </div>
                </div>

                <div>
                    <label for="senha" class="block text-[0.65rem] font-bold text-secondary/70 uppercase tracking-[0.15em] mb-2">Palavra de Poder (Senha)</label>
                    <div class="relative">
                        <span class="material-symbols-outlined absolute left-3 top-1/2 -translate-y-1/2 text-outline/50 text-xl pointer-events-none">key</span>
                        <input type="password" id="senha" name="senha" required placeholder="••••••••" 
                               class="w-full bg-surface-container-lowest border border-outline-variant/50 rounded py-3 pl-10 pr-4 text-on-surface focus:outline-none focus:border-primary transition-colors placeholder:text-outline/30">
                    </div>
                </div>

                <button type="submit" class="w-full mt-4 py-4 bg-primary-container text-on-primary-container font-bold text-[0.9rem] uppercase tracking-wider rounded cursor-pointer shadow-[0_4px_14px_rgba(249,94,20,0.25)] transition-all hover:brightness-110 hover:-translate-y-0.5">
                    Selar Destino
                </button>
            </form>

            <div class="mt-8 text-center border-t border-outline-variant/20 pt-6">
                <p class="text-secondary/60 text-sm">
                    Já possui uma marca em Eversidian? <br/>
                    <a href="/login" class="text-primary font-bold hover:underline underline-offset-4 mt-2 inline-block">Despertar (Fazer Login)</a>
                </p>
            </div>

        </div>
    </main>

    <?php include_once __DIR__ . '/../Components/footer.php'; ?>

    <script>
        const container = document.getElementById('particles');
        for (let i = 0; i < 20; i++) {
            const p = document.createElement('div');
            p.className = 'absolute w-0.5 h-0.5 bg-primary rounded-full opacity-0 animate-particle';
            p.style.cssText = `
                left: ${Math.random() * 100}%;
                --dur: ${5 + Math.random() * 10}s;
                --delay: ${Math.random() * 8}s;
                --drift: ${(Math.random() - 0.5) * 80}px;
            `;
            container.appendChild(p);
        }
    </script>
</body>
</html>