<div class="modal fade" id="modal-nuevo-usuario" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title"><b>NUEVO USUARIO</b></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="formNuevoUsuario">
          <div class="form-group">
            <label for="user" class="col-form-label">Usuario:</label>
            <input type="text" name="user" class="form-control" required>
          </div>
          <div class="form-group">
            <label for="nombre" class="col-form-label">Nombres:</label>
            <input type="text" name="nombre" class="form-control" required>
          </div>
          <div class="form-group">
            <label for="numero" class="col-form-label">Celular (requerido):</label>
            <input type="text" name="numero" class="form-control" required>
          </div>
          <div class="form-group">
            <label for="message-text" class="col-form-label">Rol:</label>
            <select name="rol" class="form-control" required>
              <option value="ADMIN">ADMINISTRADOR</option>
              <option value="COMUN">COMÚN</option>
            </select>
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
        <button type="button" class="btn btn-primary" data-dismiss="modal"  data-dismiss="modal" onclick="agregarUsuario()">Guardar</button>
      </div>
    </div>
  </div>
</div>