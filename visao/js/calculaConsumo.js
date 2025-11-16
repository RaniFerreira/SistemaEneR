document.addEventListener("DOMContentLoaded", () => {
    const kwhInput = document.getElementById('kwhInput');
    const resumo = document.getElementById('resumoConsumo');

    if (!kwhInput || !resumo) return; // garante que os elementos existem

    const tarifa = parseFloat(kwhInput.dataset.tarifa) || 0.99;

    const atualizarResumo = () => {
        const kwh = parseFloat(kwhInput.value) || 0;
        const valorEstimado = kwh * tarifa;

        resumo.textContent = `💡 Consumo: ${kwh.toFixed(2)} kWh \n\n 💰 Valor estimado: R$ ${valorEstimado.toFixed(2).replace('.', ',')}`;
    };

    // Atualiza ao carregar a página
    atualizarResumo();

    // Atualiza enquanto digita
    kwhInput.addEventListener('input', atualizarResumo);
});
