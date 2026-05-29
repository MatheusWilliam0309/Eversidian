<?php
    include_once __DIR__ . '/../../Core/Session.php';
    Session::start();
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="utf-8"/>
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <title>Adentrar o Vácuo | Eversidian</title>
    <link href="https://fonts.googleapis.com/css2?family=Newsreader:ital,opsz,wght@0,6..72,300..800;1,6..72,300..800&family=Manrope:wght@300..700&display=swap" rel="stylesheet"/>
    <link href="/assets/style.css" rel="stylesheet"/>
</head>
<body class="bg-surface text-on-surface font-body min-h-screen flex items-center justify-center relative overflow-hidden">
    
    <div class="absolute inset-0 z-0">
        <div class="absolute inset-0 bg-gradient-to-br from-[#0a0a0a] to-[#131313] opacity-90"></div>
    </div>

    <main class="relative z-10 w-full max-w-md p-8 bg-surface-container border border-outline-variant/40 rounded shadow-[0_16px_40px_rgba(0,0,0,0.6)] animate-[hero-in_0.8s_ease-out_both]">
        
        <div class="text-center mb-8">
            <h1 class="font-headline text-4xl text-primary mb-2">Eversidian</h1>
            <p class="text-secondary/60 text-sm tracking-widest uppercase">Identifique-se, Escriba</p>
        </div>

        <?php if(Session::has('erro')): ?>
            <div class="bg-primary-container/20 border border-primary-container text-primary-container p-3 rounded mb-6 text-sm text-center">
                <?php echo Session::get('erro'); Session::set('erro', null); ?>
            </div>
        <?php endif; ?>
        
        <?php if(Session::has('sucesso')): ?>
            <div class="bg-[#d6c692]/10 border border-[#d6c692]/30 text-[#d6c692] p-3 rounded mb-6 text-sm text-center">
                <?php echo Session::get('sucesso'); Session::set('sucesso', null); ?>
            </div>
        <?php endif; ?>

        <form action="/login/processar" method="POST" class="flex flex-col gap-5">
            <div>
                <label for="email" class="block text-xs font-bold text-secondary/70 uppercase tracking-wider mb-2">Pergaminho (Email)</label>
                <input type="email" id="email" name="email" required 
                       class="w-full bg-surface-container-lowest border border-outline-variant/50 rounded p-3 text-on-surface focus:outline-none focus:border-primary transition-colors">
            </div>
            
            <div>
                <label for="senha" class="block text-xs font-bold text-secondary/70 uppercase tracking-wider mb-2">Palavra-Chave (Senha)</label>
                <input type="password" id="senha" name="senha" required 
                       class="w-full bg-surface-container-lowest border border-outline-variant/50 rounded p-3 text-on-surface focus:outline-none focus:border-primary transition-colors">
            </div>

            <button type="submit" class="w-full mt-4 p-4 bg-primary-container text-on-primary-container font-bold tracking-wide rounded cursor-pointer shadow-[0_4px_14px_rgba(249,94,20,0.25)] transition-all hover:brightness-110 hover:-translate-y-0.5">
                Despertar
            </button>
        </form>

        <p class="mt-8 text-center text-sm text-secondary/50">
            Ainda não selou seu pacto? <a href="/cadastro" class="text-primary hover:underline">Forje sua Lenda</a>.
        </p>
    </main>
</body>
</html>