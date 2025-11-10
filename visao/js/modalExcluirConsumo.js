function abrirModalExcluirConsumo(idConsumo, dataLeitura) {
    document.getElementById("modalExcluirConsumo").style.display = "block";
    document.getElementById("idConsumoExcluir").value = idConsumo;
    document.getElementById("dataConsumoExcluir").textContent = dataLeitura;
}

function fecharModalExcluirConsumo() {
    document.getElementById("modalExcluirConsumo").style.display = "none";
}

// Fecha o modal ao clicar fora
window.onclick = function(event) {
    const modal = document.getElementById("modalExcluirConsumo");
    if (event.target === modal) {
        modal.style.display = "none";
    }
};
