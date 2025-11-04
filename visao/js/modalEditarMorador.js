function abrirModal(id, nome, telefone, usuario, email) {
    document.getElementById('modalEditar').style.display = 'block';
    document.getElementById('id_morador').value = id;
    document.getElementById('nome_morador').value = nome;
    document.getElementById('telefone').value = telefone;
    document.getElementById('nome_usuario').value = usuario;
    document.getElementById('email').value = email;
    document.getElementById('formEditar').action = "../Morador.php?fun=atualizarMorador&id=" + id;
}

function fecharModal() {
    document.getElementById('modalEditar').style.display = 'none';
}

window.onclick = function(event) {
  if (event.target == document.getElementById('modalEditar')) {
    fecharModal();
  }
}
