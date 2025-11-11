<div id="editarReclamacaoModal" class="modal">
    <div class="modal-content">
        <h3>Responder Reclamação</h3>
        <form method="POST" action="../Reclamacao.php?acao=editarOuvidoria">
            <input type="hidden" id="id_reclamacao_modal" name="id_reclamacao">

            <label for="titulo_modal">Título:</label>
            <input type="text" id="titulo_modal" name="titulo" required>

            <label for="descricao_modal">Descrição:</label>
            <textarea id="descricao_modal" name="descricao" rows="3" required></textarea>

            <label for="resposta_modal">Resposta:</label>
            <textarea id="resposta_modal" name="resposta" rows="3" required></textarea>

            <label for="status_modal">Status:</label>
            <select id="status_modal" name="status_reclamacao" required>
                
                <option value="Ajuste Aprovado">Ajuste Aprovado</option>
                <option value="Ajuste Reprovado">Ajuste Reprovado</option>
            </select>

            <div class="modal-buttons">
                <button type="button" id="cancelEditarReclamacao" class="btn-cancelar">Cancelar</button>
                <button type="submit" class="btn-salvar">Salvar</button>
            </div>
        </form>
    </div>
</div>
