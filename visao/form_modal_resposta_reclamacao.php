<div id="editarReclamacaoModal" class="modal">
    <div class="modal-content">
        <h3>Responder Reclamação</h3>
        <form method="POST" action="../Reclamacao.php?acao=responderOuvidoria">
            <input type="hidden" id="id_reclamacao_modal" name="id_reclamacao">

            <label for="titulo_modal">Título:</label>
            <input type="text" id="titulo_modal" name="titulo" required>

            <label for="descricao_modal">Descrição:</label>
            <textarea id="descricao_modal" name="descricao" rows="4" required></textarea>

            <label for="status_modal">Status:</label>
            <select id="status_modal" name="status_reclamacao" required>
                <option value="Ajuste">Ajuste</option>
                <option value="Aprovado">Aprovado</option>
                <option value="Ajuste Reprovado">Ajuste Reprovado</option>
            </select>

            <div class="modal-buttons">
                <button type="button" id="cancelEditarReclamacao">Cancelar</button>
                <button type="submit">Salvar</button>
            </div>
        </form>
    </div>
</div>
