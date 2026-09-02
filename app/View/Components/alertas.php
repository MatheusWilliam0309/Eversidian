<!-- app/View/Components/alertas.php -->
<?php if(isset($_SESSION['sucesso'])): ?>
    <div class="alerta-sucesso bg-green-500/10 border border-green-500/40 text-green-400 p-4 rounded mb-6 text-sm text-center font-bold tracking-wide shadow-[0_0_15px_rgba(34,197,94,0.1)]">
        <?= $_SESSION['sucesso']; unset($_SESSION['sucesso']); ?>
    </div> 
<?php endif; ?>

<?php if(isset($_SESSION['erro'])): ?>
    <div class="alerta-erro bg-primary/10 border border-primary/40 text-primary p-4 rounded mb-6 text-sm text-center font-bold tracking-wide shadow-[0_0_15px_rgba(249,94,20,0.1)]">
        <?= $_SESSION['erro']; unset($_SESSION['erro']); ?>
    </div> 
<?php endif; ?>