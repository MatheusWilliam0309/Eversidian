<?php 
// Inclui o cabeçalho padrão do seu site
include_once __DIR__ . '/../Components/header.php'; 
?>

<main class="container mx-auto px-4 py-8 min-h-screen">
    <div class="flex justify-between items-center mb-8">
        <h1 class="text-3xl font-bold text-gray-100">Seu Inventário / Carrinho</h1>
        <a href="/loja" class="text-green-400 hover:text-green-300 underline text-sm transition">Continuar comprando</a>
    </div>

    <div class="flex flex-col lg:flex-row gap-8">
        <!-- Lista de Itens (Esquerda) -->
        <div class="w-full lg:w-2/3 bg-gray-800 rounded-lg shadow-md p-6 border border-gray-700">
            <h2 class="text-xl font-semibold text-white border-b border-gray-700 pb-4 mb-4">Itens Selecionados</h2>

            <!-- Exemplo de Item 1 -->
            <div class="flex items-center justify-between py-4 border-b border-gray-700/50">
                <div class="flex items-center gap-4">
                    <div class="w-16 h-16 bg-gray-700 rounded flex items-center justify-center text-2xl">
                        ⚔️
                    </div>
                    <div>
                        <h3 class="text-lg font-bold text-gray-200">Espada Longa de Aço</h3>
                        <p class="text-sm text-gray-400">Arma Física • +15 Dano</p>
                    </div>
                </div>
                <div class="flex items-center gap-6">
                    <div class="flex items-center gap-2">
                        <button class="w-8 h-8 rounded bg-gray-700 text-white hover:bg-gray-600 font-bold">-</button>
                        <span class="text-gray-200 font-medium">1</span>
                        <button class="w-8 h-8 rounded bg-gray-700 text-white hover:bg-gray-600 font-bold">+</button>
                    </div>
                    <div class="text-right">
                        <p class="text-lg font-bold text-green-400">250 🪙</p>
                    </div>
                    <button class="text-red-500 hover:text-red-400" title="Remover item">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                        </svg>
                    </button>
                </div>
            </div>

            <!-- Exemplo de Item 2 -->
            <div class="flex items-center justify-between py-4">
                <div class="flex items-center gap-4">
                    <div class="w-16 h-16 bg-gray-700 rounded flex items-center justify-center text-2xl">
                        🧪
                    </div>
                    <div>
                        <h3 class="text-lg font-bold text-gray-200">Poção de Cura Menor</h3>
                        <p class="text-sm text-gray-400">Consumível • Restaura 50 HP</p>
                    </div>
                </div>
                <div class="flex items-center gap-6">
                    <div class="flex items-center gap-2">
                        <button class="w-8 h-8 rounded bg-gray-700 text-white hover:bg-gray-600 font-bold">-</button>
                        <span class="text-gray-200 font-medium">3</span>
                        <button class="w-8 h-8 rounded bg-gray-700 text-white hover:bg-gray-600 font-bold">+</button>
                    </div>
                    <div class="text-right">
                        <p class="text-lg font-bold text-green-400">150 🪙</p>
                    </div>
                    <button class="text-red-500 hover:text-red-400" title="Remover item">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                        </svg>
                    </button>
                </div>
            </div>
        </div>

        <!-- Resumo do Pedido (Direita) -->
        <div class="w-full lg:w-1/3">
            <div class="bg-gray-800 rounded-lg shadow-md p-6 border border-gray-700 sticky top-4">
                <h2 class="text-xl font-semibold text-white border-b border-gray-700 pb-4 mb-4">Resumo da Compra</h2>
                
                <div class="space-y-3 mb-6 text-gray-300">
                    <div class="flex justify-between">
                        <span>Subtotal (4 itens)</span>
                        <span>400 🪙</span>
                    </div>
                    <div class="flex justify-between">
                        <span>Taxa da Guilda</span>
                        <span>0 🪙</span>
                    </div>
                    <div class="border-t border-gray-700 pt-3 mt-3 flex justify-between font-bold text-lg text-white">
                        <span>Total</span>
                        <span class="text-green-400">400 🪙</span>
                    </div>
                </div>

                <button class="w-full bg-green-600 hover:bg-green-500 text-white font-bold py-3 px-4 rounded transition duration-200 shadow-[0_0_15px_rgba(34,197,94,0.2)]">
                    Finalizar Compra
                </button>
                
                <p class="text-xs text-gray-500 text-center mt-4">
                    Suas moedas serão deduzidas do saldo do personagem selecionado.
                </p>
            </div>
        </div>
    </div>
</main>

<?php 
// Inclui o rodapé padrão
include_once __DIR__ . '/../Components/footer.php'; 
?>