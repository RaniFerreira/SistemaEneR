<div id="modalExcluir" class="modal-excluir">
    <div class="modal-excluir-content">
        <span class="close" onclick="fecharModalExcluir()">&times;</span>
        <h3>Confirmar Exclusão</h3>
        <p>Tem certeza que deseja excluir o morador <b id="nomeMoradorExcluir"></b>?</p>

        <form id="formExcluirMorador" method="GET" action="../Morador.php">
            <input type="hidden" name="fun" value="excluirMorador">
            <input type="hidden" id="idMoradorExcluir" name="id">
            <div class="botoes">
                <button type="button" onclick="fecharModalExcluir()" class="btn-cancelar">Cancelar</button>
                <button type="submit" class="btn-confirmar">Excluir</button>
            </div>
        </form>
    </div>
</div>
