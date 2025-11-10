// modalBoleto.js

// Abre o modal
function abrirModalBoleto() {
    const modal = document.getElementById('boletoModal');
    if (modal) {
        modal.style.display = 'flex';
    }
}

// Fecha o modal ao clicar no "X" ou fora da área do modal
document.addEventListener('DOMContentLoaded', () => {
    const modal = document.getElementById('boletoModal');
    const closeBtn = modal ? modal.querySelector('#closeModal') : null;

    if (closeBtn) {
        closeBtn.addEventListener('click', () => {
            modal.style.display = 'none';
            // Não mexe na URL, porque seu roteador precisa de ?pagina=boletos
        });
    }

    // Fecha ao clicar fora do modal
    window.addEventListener('click', (e) => {
        if (e.target === modal) {
            modal.style.display = 'none';
        }
    });
});
