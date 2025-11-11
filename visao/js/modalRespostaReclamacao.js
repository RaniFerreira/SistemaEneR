// Função para abrir o modal com dados da reclamação
function abrirModalReclamacao(id, titulo, descricao, resposta, status) {
    document.getElementById('id_reclamacao_modal').value = id;
    document.getElementById('titulo_modal').value = titulo;
    document.getElementById('descricao_modal').value = descricao;
    document.getElementById('resposta_modal').value = resposta || '';
    document.getElementById('status_modal').value = status;

    document.getElementById('editarReclamacaoModal').style.display = 'flex';
}

// Fechar o modal
document.getElementById('cancelEditarReclamacao').addEventListener('click', function() {
    document.getElementById('editarReclamacaoModal').style.display = 'none';
});

// Fechar clicando fora do conteúdo
window.addEventListener('click', function(e) {
    const modal = document.getElementById('editarReclamacaoModal');
    if (e.target === modal) {
        modal.style.display = 'none';
    }
});
