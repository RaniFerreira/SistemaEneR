<div id="modalExcluirConsumo" class="modal-excluir">
    <div class="modal-excluir-content">
        <span class="close" onclick="fecharModalExcluirConsumo()">&times;</span>
        <h3>Confirmar Exclusão</h3>
        <p>Tem certeza que deseja excluir o consumo do dia <b id="dataConsumoExcluir"></b>?</p>

        <form id="formExcluirConsumo" method="GET" action="../ConsumoSindico.php">
            <input type="hidden" name="fun" value="excluirConsumo">
            <input type="hidden" id="idConsumoExcluir" name="id_consumo">
            <input type="hidden" name="id_morador" value="<?= isset($_GET['id_morador']) ? $_GET['id_morador'] : '' ?>">
            <div class="botoes">
                <button type="button" onclick="fecharModalExcluirConsumo()" class="btn-cancelar">Cancelar</button>
                <button type="submit" class="btn-confirmar">Excluir</button>
            </div>
        </form>
    </div>
</div>
