function abrirModalBoleto(element) {
    document.getElementById('modalMorador').textContent = element.dataset.morador;
    document.getElementById('modalCondominio').textContent = element.dataset.condominio;
    document.getElementById('modalEmissao').textContent = element.dataset.emissao;
    document.getElementById('modalVencimento').textContent = element.dataset.vencimento;
    document.getElementById('modalValor').textContent = element.dataset.valor;
    document.getElementById('modalStatus').textContent = element.dataset.status;
    document.getElementById('modalKwh').textContent = element.dataset.kwh;

    document.getElementById('boletoModal').style.display = 'flex';
}

function fecharModal() {
    document.getElementById('boletoModal').style.display = 'none';
}
