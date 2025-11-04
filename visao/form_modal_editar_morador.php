<div id="modalEditar" class="modal">
  <div class="modal-content">
    <span class="fechar" onclick="fecharModal()">&times;</span>
    <h2>Editar Morador</h2>
    <form id="formEditar" method="POST">
      <input type="hidden" name="id_morador" id="id_morador">

      <label>Nome de Usuário:</label>
      <input type="text" name="nome_usuario" id="nome_usuario" required>

      <label>Email:</label>
      <input type="email" name="email" id="email" required>

      <label>Senha (deixe em branco para não alterar):</label>
      <input type="password" name="senha" id="senha">

      <label>Nome do Morador:</label>
      <input type="text" name="nome_morador" id="nome_morador" required>

      <label>Telefone:</label>
      <input type="text" name="telefone" id="telefone" required>

      <input type="submit" value="Atualizar Morador">
    </form>
  </div>
</div>
