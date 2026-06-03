<!DOCTYPE html>
<html lang="pt-BR">
<head>
<meta charset="utf-8"/>
<meta content="width=device-width, initial-scale=1.0" name="viewport"/>
<title>Eversidian | Engine de RPG Dark Fantasy</title>
<link href="https://fonts.googleapis.com/css2?family=Newsreader:ital,opsz,wght@0,6..72,300..800;1,6..72,300..800&family=Manrope:wght@300..700&family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet"/>
<link href="./Public/Assets/css/style.css" rel="stylesheet"/>
</head>
<body class="bg-surface text-on-surface font-body overflow-x-hidden scroll-smooth flex flex-col min-h-screen">

  <?php include_once __DIR__ . '/../Components/header.php'; ?>

  <main class="flex-1">
    
    <section class="relative min-h-screen flex items-center justify-center overflow-hidden px-6 pt-20">
      <div class="absolute inset-0 z-0">
        <img src="https://lh3.googleusercontent.com/aida-public/AB6AXuAfBApsPQqBqI9_ayRcisQNE0lTGea9opBHeMNsX_fRB9qxBt6gwdWgdv9bqAN1NiGiUMOcPnMH33D_Yf_ex5vxKAEHLe6bAs4su6ocLxUfEVeOwcqTX_jZGMJE1ouKedS1A-DcVlngha2PueDKU9k210D7I7J5NaDdMY5FljvPZl31I90esOid9rsRmrWLFtTAQmDEDreeVkNFUT-NyHhdCW8-z_0HYl88dagmKi9ZXjO7u7am3NJERhNntj7pHxG0dyShbP_sB88" class="w-full h-full object-cover opacity-40 grayscale mix-blend-luminosity" alt="Dark fantasy landscape"/>
        <div class="absolute inset-0 hero-gradient"></div>
      </div>
      
      <div id="particles" class="absolute inset-0 z-1 pointer-events-none overflow-hidden"></div>

      <div class="relative z-10 text-center max-w-[60rem] mx-auto animate-[hero-in_1.2s_cubic-bezier(0.16,1,0.3,1)_both]">
        <span class="inline-block text-[0.7rem] tracking-[0.25em] uppercase text-primary font-semibold mb-6 px-4 py-1 border border-primary/25 rounded-full bg-primary/5">Engine de RPG Dark Fantasy</span>
        <h1 class="font-headline text-[clamp(2.8rem,8vw,6.5rem)] leading-[1.05] tracking-tight text-on-surface mb-6">Forje sua Lenda no <br/><em class="text-primary italic drop-shadow-[0_0_60px_rgba(255,181,154,0.3)]">Eversidian</em></h1>
        <p class="font-headline text-[clamp(1rem,2vw,1.35rem)] text-secondary italic max-w-[34rem] mx-auto mb-12 leading-relaxed opacity-90">A primeira engine de RPG digital que respira a atmosfera dos clássicos enquanto domina a tecnologia moderna.</p>
        <div class="flex flex-wrap justify-center gap-4">
          <!-- Rota limpa para Campanhas -->
          <a href="/campanhas" class="no-underline"><button class="px-10 py-4 bg-primary-container text-on-primary-container font-bold text-base rounded-sm shadow-[0_8px_24px_rgba(249,94,20,0.35)] transition-all tracking-wide cursor-pointer hover:brightness-110 hover:-translate-y-1 hover:shadow-[0_12px_32px_rgba(249,94,20,0.45)]">Começar Campanha</button></a>
          <!-- Rota limpa para Crônicas -->
          <a href="/cronicas" class="no-underline"><button class="px-10 py-4 bg-surface-container-high text-secondary font-bold text-base border border-outline/25 rounded-sm transition-all tracking-wide cursor-pointer hover:bg-surface-bright hover:-translate-y-1">Ver Crônicas</button></a>
        </div>
      </div>
      
      <div class="absolute bottom-10 left-1/2 -translate-x-1/2 z-10 flex flex-col items-center gap-1 opacity-40 animate-pulse">
        <span class="material-symbols-outlined text-[1.4rem] text-secondary">expand_more</span>
        <span class="text-[0.6rem] tracking-[0.2em] uppercase text-secondary">Descer</span>
      </div>
    </section>

    <section class="py-28 px-8 max-w-[90rem] mx-auto">
      <div class="text-center mb-16 reveal">
        <span class="text-[0.65rem] tracking-[0.25em] uppercase text-primary font-semibold block mb-3">Arsenais do Escriba</span>
        <h2 class="font-headline text-[clamp(2rem,4vw,3.2rem)] mb-3">Tecnologias do Além</h2>
        <p class="text-secondary opacity-60 text-[0.85rem] tracking-[0.18em] uppercase">Cada feitiço, forjado em código</p>
      </div>

      <div class="grid grid-cols-1 md:grid-cols-12 gap-5">
        <div class="md:col-span-8 bg-surface-container border border-outline-variant/40 rounded flex flex-col relative overflow-hidden transition-all duration-300 group hover:border-outline/50 hover:-translate-y-1 hover:shadow-[0_16px_40px_rgba(0,0,0,0.4)] reveal">
          <img src="https://lh3.googleusercontent.com/aida-public/AB6AXuCSRKIb1It1iOeKcSK87r8FNKySl3oxD5uRoAYZjZ24cJKlxj4Ebz8wkbQbWrtROuMYGwvNGbPqgY-mfFRLxQY_2PBpGx2XidKgmWLtgEMPQYt13mfMog57Hxupza9yTO2Cv8cZqOv7beMwW0a-PrPERUmn3xFEoA-A2oaHB7boUuV5_zoikV-vvYLZy7xkziJXxw46BGD6iFCV4ptkKcqc3ThkQUjnxKX4zJuotWubFSf4vAKFpLGNfek295D9Te2pFFqZD62jt8I" class="w-full h-[260px] object-cover opacity-45 transition-all duration-800 group-hover:scale-105 group-hover:opacity-55" alt="Dungeon map with fog"/>
          <div class="p-8 pb-10">
            <span class="text-[0.65rem] font-bold tracking-[0.2em] uppercase text-primary">Tecnologia Arcaica</span>
            <h3 class="font-headline text-[clamp(1.4rem,2vw,2rem)] text-on-surface mt-2 mb-4">Nevoeiro de Guerra Dinâmico</h3>
            <p class="text-[#d6c692]/70 leading-relaxed text-[0.9rem] max-w-[32rem]">Simulação de luz e sombra em tempo real. Seus jogadores sentirão o peso do desconhecido em cada corredor escuro, com cálculos de linha de visão precisos e atmosféricos.</p>
          </div>
        </div>

        <div class="md:col-span-4 bg-[#0e0e0e] border border-outline-variant/40 rounded flex flex-col justify-between p-10 relative transition-all duration-300 hover:border-outline/50 hover:-translate-y-1 hover:shadow-[0_16px_40px_rgba(0,0,0,0.4)] reveal reveal-delay-1">
          <div class="w-12 h-12 bg-[#f95e14]/10 flex items-center justify-center rounded mb-8">
            <span class="material-symbols-outlined text-primary text-3xl">auto_stories</span>
          </div>
          <div>
            <h3 class="font-headline text-2xl text-on-surface mb-3">Fichas com Cálculos Automáticos</h3>
            <p class="text-[#d6c692]/65 text-[0.85rem] leading-relaxed">Esqueça as calculadoras. Do modificador de força ao dano de bolas de fogo maximizadas, nossa engine processa tudo em milissegundos.</p>
          </div>
        </div>

        <div class="md:col-span-5 bg-surface-container border border-outline-variant/40 rounded flex flex-col items-center justify-center text-center p-12 relative overflow-hidden transition-all duration-300 group hover:border-outline/50 hover:-translate-y-1 hover:shadow-[0_16px_40px_rgba(0,0,0,0.4)] reveal reveal-delay-2">
          <span class="material-symbols-outlined absolute -bottom-6 -right-6 text-[11rem] opacity-5 transition-opacity duration-400 group-hover:opacity-10 pointer-events-none" style="font-variation-settings: 'FILL' 1;">shield</span>
          <span class="material-symbols-outlined text-primary text-6xl mb-6">devices</span>
          <h3 class="font-headline text-2xl text-on-surface mb-3">Jogo Multiplataforma</h3>
          <p class="text-[#d6c692]/65 text-[0.85rem] leading-relaxed">Mestre no PC, jogadores no tablet ou celular. O Grimório sincroniza cada rolagem de dados instantaneamente entre todos os dispositivos.</p>
        </div>

        <div class="md:col-span-7 bg-[#0a0a0a] border border-outline-variant/40 rounded flex items-center relative min-h-[200px] overflow-hidden transition-all duration-300 hover:border-outline/50 hover:-translate-y-1 hover:shadow-[0_16px_40px_rgba(0,0,0,0.4)] reveal reveal-delay-3">
          <div class="p-12 z-10 flex-1">
            <h3 class="font-headline text-[clamp(1.5rem,2.2vw,2.2rem)] text-primary mb-4">O Escriba Digital</h3>
            <p class="text-[#d6c692]/75 leading-relaxed text-[0.9rem] max-w-[28rem]">Um assistente de IA treinado em narrativas de fantasia para ajudar a criar descrições imersivas, nomes de NPCs e ganchos de aventura em segundos.</p>
          </div>
          <div class="absolute right-0 top-0 h-full w-[38%] hidden md:block">
            <img src="https://lh3.googleusercontent.com/aida-public/AB6AXuBA_JpuDQU1q38_dXBsRyfdnflwuom2g0Fj8FC_iZRYttM9J5MF2TvQyLXeXnuBIXMGBsgAMw-ffuNl59axbV8XmjrlHxM5tOtJ9FNUXUTT7xldBooWpNBuGzz4McbEK6QN1D9HX4EcrzNX9pXxcIBlLN78Rb4IJ7js7IK-mfYYNxxowKv7UybO_LevpMWZ8TCGwrFzmLdsk2iQ6oDnJD8QPnioeUtwuFqh3RXhVoHhNmUVCARQ9VbA9vp_jlr4xH0Ew34YIYXcf9A" class="h-full w-full object-cover opacity-35" alt="Mystical library"/>
            <div class="absolute inset-0 z-1 bg-gradient-to-r from-[#0a0a0a] to-transparent"></div>
          </div>
        </div>
      </div>
    </section>

    <section class="py-28 px-8 bg-surface-container-lowest">
      <div class="max-w-[58rem] mx-auto">
        <div class="text-center mb-16 reveal">
          <span class="text-[0.65rem] tracking-[0.25em] uppercase text-primary font-semibold block mb-3">Pactos de Poder</span>
          <h2 class="font-headline text-[clamp(2rem,4vw,3.2rem)] mb-3">Escolha seu Destino</h2>
          <p class="text-[#d6c692]/50 text-[0.65rem] tracking-[0.28em] uppercase">O preço do poder é relativo</p>
        </div>
        
        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
          <div class="bg-surface border border-outline-variant/50 rounded p-11 relative overflow-hidden transition-all duration-300 hover:border-outline hover:-translate-y-1 reveal">
            <span class="material-symbols-outlined absolute top-0 right-0 p-4 opacity-[0.07] text-[4rem] pointer-events-none">directions_walk</span>
            <h3 class="font-headline text-3xl text-secondary mb-2">O Viajante</h3>
            <div class="text-[2.8rem] font-bold italic text-on-surface mb-8 leading-none">Grátis <span class="text-[0.9rem] font-normal not-italic text-[#d6c692]/40 ml-1">/eterno</span></div>
            <ul class="flex flex-col gap-4 mb-10">
              <li class="flex items-center gap-3 text-[#d6c692]/80 text-[0.88rem]"><span class="material-symbols-outlined text-primary text-lg">check_circle</span> Até 3 Campanhas Ativas</li>
              <li class="flex items-center gap-3 text-[#d6c692]/80 text-[0.88rem]"><span class="material-symbols-outlined text-primary text-lg">check_circle</span> 1 GB de Armazenamento de Assets</li>
              <li class="flex items-center gap-3 text-[#d6c692]/80 text-[0.88rem]"><span class="material-symbols-outlined text-primary text-lg">check_circle</span> Compêndio Básico (SRD 5e)</li>
            </ul>
            <!-- Rota limpa -->
            <a href="/campanhas" class="no-underline"><button class="w-full p-4 bg-transparent border border-outline-variant/60 text-secondary font-bold text-[0.9rem] tracking-wide rounded cursor-pointer transition-all hover:bg-surface-container hover:border-outline hover:-translate-y-0.5">Iniciar Jornada</button></a>
          </div>
          
          <div class="bg-surface-container-high border-2 border-primary-container shadow-[0_0_50px_rgba(249,94,20,0.12)] rounded p-11 relative overflow-hidden transition-all duration-300 hover:-translate-y-1 reveal reveal-delay-1">
            <div class="absolute -top-12 -right-12 w-24 h-24 bg-primary-container/20 rotate-45"></div>
            <span class="material-symbols-outlined absolute top-5 right-5 text-primary-container text-2xl" style="font-variation-settings: 'FILL' 1;">star</span>
            
            <h3 class="font-headline text-3xl text-primary mb-2">O Alto Escriba</h3>
            <div class="text-[2.8rem] font-bold italic text-on-surface mb-8 leading-none">R$ 60 <span class="text-[0.9rem] font-normal not-italic text-[#d6c692]/40 ml-1">/mês</span></div>
            <ul class="flex flex-col gap-4 mb-10">
              <li class="flex items-center gap-3 text-on-surface-variant text-[0.88rem]"><span class="material-symbols-outlined text-primary-container text-lg" style="font-variation-settings: 'FILL' 1;">check_circle</span> Campanhas Ilimitadas</li>
              <li class="flex items-center gap-3 text-on-surface-variant text-[0.88rem]"><span class="material-symbols-outlined text-primary-container text-lg" style="font-variation-settings: 'FILL' 1;">check_circle</span> 50 GB de Nuvem e Assets 4K</li>
              <li class="flex items-center gap-3 text-on-surface-variant text-[0.88rem]"><span class="material-symbols-outlined text-primary-container text-lg" style="font-variation-settings: 'FILL' 1;">check_circle</span> Nevoeiro de Guerra Volumétrico</li>
              <li class="flex items-center gap-3 text-on-surface-variant text-[0.88rem]"><span class="material-symbols-outlined text-primary-container text-lg" style="font-variation-settings: 'FILL' 1;">check_circle</span> Customização de Shaders de Mapa</li>
            </ul>
            <button class="w-full p-4 bg-primary-container text-on-primary-container font-bold text-[0.9rem] tracking-wide border-none rounded cursor-pointer shadow-[0_4px_14px_rgba(0,0,0,0.45)] transition-all hover:brightness-110">Ascender agora</button>
          </div>
        </div>
      </div>
    </section>

    <section class="py-32 px-6 text-center relative overflow-hidden">
      <div class="absolute inset-0 bg-primary/5 skew-y-[-3deg] origin-right pointer-events-none"></div>
      <div class="relative z-10 reveal">
        <h2 class="font-headline text-[clamp(2rem,5vw,3.5rem)] mb-5 max-w-[40rem] mx-auto">O Vácuo aguarda suas histórias.</h2>
        <p class="text-secondary italic mb-12 max-w-[30rem] mx-auto leading-relaxed">Junte-se a mais de 10.000 escribas que já estão moldando seus próprios mundos.</p>
        <div class="inline-block p-1 bg-gradient-to-br from-primary to-primary-container rounded">
          <!-- Rota limpa -->
          <a href="/cadastro" class="block bg-surface px-14 py-5 font-bold uppercase tracking-[0.18em] text-[0.85rem] text-primary cursor-pointer border-none rounded transition-all hover:bg-transparent hover:text-on-primary no-underline">Forjar meu Destino</a>
        </div>
      </div>
    </section>

  </main>

  <?php include_once __DIR__ . '/../Components/footer.php'; ?>

  <script>
    /* Particles */
    const container = document.getElementById('particles');
    for (let i = 0; i < 28; i++) {
      const p = document.createElement('div');
      p.className = 'absolute w-0.5 h-0.5 bg-primary rounded-full opacity-0 animate-particle';
      p.style.cssText = `
        left: ${Math.random() * 100}%;
        --dur: ${5 + Math.random() * 10}s;
        --delay: ${Math.random() * 8}s;
        --drift: ${(Math.random() - 0.5) * 120}px;
      `;
      container.appendChild(p);
    }

    /* Scroll reveal observer */
    const observer = new IntersectionObserver((entries) => {
      entries.forEach(e => { if (e.isIntersecting) { e.target.classList.add('visible'); } });
    }, { threshold: 0.12 });
    document.querySelectorAll('.reveal').forEach(el => observer.observe(el));
  </script>
</body>
</html>