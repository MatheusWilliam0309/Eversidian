<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="utf-8"/>
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <title>Despertar | Eversidian</title>
    <link href="https://fonts.googleapis.com/css2?family=Newsreader:ital,opsz,wght@0,6..72,300..800;1,6..72,300..800&family=Manrope:wght@300..700&family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet"/>
    <link href="/Public/Assets/css/style.css" rel="stylesheet"/>
</head>
<body class="bg-surface text-on-surface font-body overflow-x-hidden flex flex-col min-h-screen relative">
    
    <div id="particles" class="absolute inset-0 z-0 pointer-events-none overflow-hidden opacity-40"></div>

    <?php include_once __DIR__ . '/../Components/header.php'; ?>

    <main class="flex-1 flex items-center justify-center pt-32 pb-20 px-6 relative z-10">
        <div class="w-full max-w-md bg-surface-container-low border border-outline-variant/30 rounded shadow-[0_16px_40px_rgba(0,0,0,0.6)] p-10 relative overflow-hidden">
            
            <div class="absolute -top-12 -left-12 w-24 h-24 bg-primary/5 rotate-45 pointer-events-none"></div>

            <div class="text-center mb-10">
                <span class="material-symbols-outlined text-primary text-5xl mb-4">vpn_key</span>
                <h1 class="font-headline text-4xl mb-2">O <em class="text-primary italic">Despertar</em></h1>
                <p class="text-secondary/60 text-sm font-light">Identifique-se para aceder aos seus reinos.</p>
            </div>

            <?php if(isset($_SESSION['sucesso'])): ?>
                <div class="alerta-sucesso bg-green-500/10 border border-green-500/40 text-green-400 p-4 rounded mb-6 text-sm text-center font-bold tracking-wide shadow-[0_0_15px_rgba(34,197,94,0.1)]">
                    <?= $_SESSION['sucesso']; unset($_SESSION['sucesso']); ?>
                </div>
            <?php endif; ?>

            <?php if(isset($_SESSION['erro'])): ?>
                <div class="bg-primary-container/10 border border-primary-container/50 text-primary-container p-4 rounded mb-6 text-sm text-center font-semibold">
                    <?= $_SESSION['erro']; unset($_SESSION['erro']); ?>
                </div>
            <?php endif; ?>

            <form action="/login-processar" method="POST" class="flex flex-col gap-5">
                
                <div>
                    <label for="email" class="block text-[0.65rem] font-bold text-secondary/70 uppercase tracking-[0.15em] mb-2">Selo de Contacto (E-mail)</label>
                    <div class="relative">
                        <span class="material-symbols-outlined absolute left-3 top-1/2 -translate-y-1/2 text-outline/50 text-xl pointer-events-none">mail</span>
                        <input type="email" id="email" name="email" required placeholder="seu@email.com" 
                               class="w-full bg-surface-container-lowest border border-outline-variant/50 rounded py-3 pl-10 pr-4 text-on-surface focus:outline-none focus:border-primary transition-colors placeholder:text-outline/30">
                    </div>
                </div>

                <div>
                    <div class="flex justify-between items-center mb-2">
                        <label for="senha" class="block text-[0.65rem] font-bold text-secondary/70 uppercase tracking-[0.15em]">Palavra de Poder (Senha)</label>
                        <a href="/recuperar-senha" class="text-[0.65rem] text-primary hover:underline underline-offset-2">Esqueceu o feitiço?</a>
                    </div>
                    <div class="relative">
                        <span class="material-symbols-outlined absolute left-3 top-1/2 -translate-y-1/2 text-outline/50 text-xl pointer-events-none">password</span>
                        <input type="password" id="senha" name="senha" required placeholder="••••••••" 
                               class="w-full bg-surface-container-lowest border border-outline-variant/50 rounded py-3 pl-10 pr-4 text-on-surface focus:outline-none focus:border-primary transition-colors placeholder:text-outline/30">
                    </div>
                </div>

                <button type="submit" class="w-full mt-4 py-4 bg-surface-container-high text-secondary border border-outline/30 font-bold text-[0.9rem] uppercase tracking-wider rounded cursor-pointer transition-all hover:bg-primary-container hover:text-on-primary-container hover:border-primary-container">
                    Atravessar o Portal
                </button>
            </form>

            <div class="mt-8 text-center border-t border-outline-variant/20 pt-6">
                <p class="text-secondary/60 text-sm">
                    Ainda não possui uma marca? <br/>
                    <a href="/cadastro" class="text-primary font-bold hover:underline underline-offset-4 mt-2 inline-block">Forjar Pacto (Criar Conta)</a>
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