<footer class="bg-surface-container-lowest border-t border-outline-variant/30 py-12 px-6">
    <div class="max-w-[90rem] mx-auto grid grid-cols-1 md:grid-cols-4 gap-8 mb-8">
        <div class="md:col-span-2">
            <h3 class="font-headline text-2xl text-primary mb-4">Eversidian</h3>
            <p class="text-secondary/60 text-sm max-w-sm leading-relaxed">
                A primeira engine de RPG digital que respira a atmosfera dos clássicos enquanto domina a tecnologia moderna.
            </p>
        </div>
        <div>
            <h4 class="text-on-surface font-bold text-sm tracking-widest uppercase mb-4">Explorar</h4>
            <ul class="flex flex-col gap-2">
                <li><a href="/campanhas" class="text-secondary/60 hover:text-primary text-sm transition-colors no-underline">Campanhas</a></li>
                <li><a href="/cronicas" class="text-secondary/60 hover:text-primary text-sm transition-colors no-underline">Crônicas</a></li>
                <li><a href="/loja" class="text-secondary/60 hover:text-primary text-sm transition-colors no-underline">Loja Virtual</a></li>
            </ul>
        </div>
        <div>
            <h4 class="text-on-surface font-bold text-sm tracking-widest uppercase mb-4">Pactos</h4>
            <ul class="flex flex-col gap-2">
                <li><a href="/planos" class="text-secondary/60 hover:text-primary text-sm transition-colors no-underline">Assinaturas</a></li>
                <li><a href="/suporte" class="text-secondary/60 hover:text-primary text-sm transition-colors no-underline">Suporte aos Escribas</a></li>
            </ul>
        </div>
    </div>
    <div class="max-w-[90rem] mx-auto border-t border-outline-variant/20 pt-8 flex flex-col md:flex-row justify-between items-center gap-4">
        <span class="text-secondary/40 text-xs tracking-wider">© <?= date('Y') ?> Eversidian. Todos os direitos reservados.</span>
    </div>
</footer>