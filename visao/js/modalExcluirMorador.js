function abrirModalExcluir(idMorador, nomeMorador) {
    document.getElementById("modalExcluir").style.display = "block";
    document.getElementById("idMoradorExcluir").value = idMorador;
    document.getElementById("nomeMoradorExcluir").textContent = nomeMorador;
}

function fecharModalExcluir() {
    document.getElementById("modalExcluir").style.display = "none";
}

// Fecha o modal ao clicar fora
window.onclick = function(event) {
    const modal = document.getElementById("modalExcluir");
    if (event.target === modal) {
        modal.style.display = "none";
    }
};
