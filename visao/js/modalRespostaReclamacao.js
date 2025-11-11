const modal = document.getElementById('editarReclamacaoModal');

function abrirModalEditarReclamacao(id, titulo, descricao, status) {
    document.getElementById('id_reclamacao_modal').value = id;
    document.getElementById('titulo_modal').value = titulo;
    document.getElementById('descricao_modal').value = descricao;
    document.getElementById('status_modal').value = status;

    modal.style.display = 'flex';
}

// Fechar modal ao clicar em cancelar
document.getElementById('cancelEditarReclamacao').onclick = function() {
    modal.style.display = 'none';
}

// Fechar modal clicando fora
window.onclick = function(event) {
    if (event.target === modal) {
        modal.style.display = 'none';
    }
}
