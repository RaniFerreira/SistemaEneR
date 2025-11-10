function abrirModalEditarConsumo(id, kwh) {
    // Abre o modal
    document.getElementById('modalEditarConsumo').style.display = 'block';

    // Preenche os campos
    document.getElementById('id_consumo').value = id;
    document.getElementById('kwh').value = kwh;

    // Define o action do form
    document.getElementById('formEditarConsumo').action = 
        "../ConsumoSindico.php?fun=atualizarConsumo&id_consumo=" + id;
}

function fecharModalEditarConsumo() {
    document.getElementById('modalEditarConsumo').style.display = 'none';
}

// Fechar clicando fora
window.onclick = function(event) {
    const modal = document.getElementById('modalEditarConsumo');
    if (event.target === modal) {
        fecharModalEditarConsumo();
    }
};
