document.addEventListener("DOMContentLoaded", function() {
    let checkboxAtivo = null;

    window.confirmarPagamento = function(checkbox) {
        checkboxAtivo = checkbox;
        document.getElementById('confirmModal').style.display = 'block';
    }

    document.getElementById('confirmBtn').addEventListener('click', function() {
        document.getElementById('formBoletos').submit();
    });

    document.getElementById('cancelBtn').addEventListener('click', function() {
        if (checkboxAtivo) checkboxAtivo.checked = false;
        document.getElementById('confirmModal').style.display = 'none';
    });

    window.onclick = function(event) {
        const modal = document.getElementById('confirmModal');
        if (event.target == modal) {
            if (checkboxAtivo) checkboxAtivo.checked = false;
            modal.style.display = "none";
        }
    }
});
