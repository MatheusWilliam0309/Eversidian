document.addEventListener('DOMContentLoaded', function() {
    const btnAbrir = document.getElementById('btn-abrir-dados');
    const menuDados = document.getElementById('menu-dados');
    const inputChat = document.getElementById('input-mensagem-chat'); // Seu input de texto do chat
    const botoesDado = document.querySelectorAll('.btn-dado');

    // Abre e fecha o dropbox
    btnAbrir.addEventListener('click', function() {
        menuDados.classList.toggle('hidden');
    });

    // Função para rolar usando a interface
    botoesDado.forEach(function(botao) {
        botao.addEventListener('click', function() {
            const dadoA_Rolar = this.getAttribute('data-dado'); // ex: "1d20"
            
            // Aqui você tem duas opções de implementação:
            // Opção 1: Injeta o comando no chat e envia automaticamente
            inputChat.value = '/roll ' + dadoA_Rolar;
            document.getElementById('form-chat').submit(); 
            // *Quando integrarmos o WebSocket, ao invés de submit(), enviaremos pelo socket*

            // Fecha o menu após clicar
            menuDados.classList.add('hidden');
        });
    });
});