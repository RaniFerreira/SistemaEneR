<div id="modalEditarConsumo" class="modal">
    <div class="modal-content">

        <h2><i class="fa-solid fa-pen-to-square"></i> Editar Consumo</h2>

        <form id="formEditarConsumo" method="POST">

            <!-- ID oculto -->
            <input type="hidden" id="id_consumo" name="id_consumo">

            <label for="kwh">kWh Consumidos:</label>
            <input type="number" id="kwh" name="kwh" required min="0" step="0.01">

            <div style="display:flex; justify-content:end; gap:10px; margin-top:20px;">
                <button type="button" 
                        onclick="fecharModalEditarConsumo()" 
                        style="background:#777; color:white; padding:6px 14px; border:none; border-radius:5px;">
                    Cancelar
                </button>

                <button type="submit" 
                        style="background:#0288d1; color:white; padding:6px 14px; border:none; border-radius:5px;">
                    Salvar
                </button>
            </div>

        </form>

    </div>
</div>
