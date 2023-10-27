<div class="modal fade" id="modal-editar-usuario" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel"><b>EDITAR USUARIO</b></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="formEditarUsuario">
          <input type="hidden" name="idUsuario" id="idUsuario_edit" value="">
          <div class="form-group">
            <label for="user" class="col-form-label">Usuario:</label>
            <input type="text" name="user" class="form-control" id="user" required>
          </div>
          <div class="form-group">
            <label for="nombre" class="col-form-label">Nombres:</label>
            <input type="text" name="nombre" class="form-control" id="nombre" required>
          </div>
          <div class="form-group">
            <label for="celular" class="col-form-label">celular:</label>
            <input type="text" name="celular" class="form-control" id="celular" required>
          </div>
          <div class="form-group">
            <label for="message-text" class="col-form-label">Rol:</label>
            <select name="rol" class="form-control" required>
              <option value="ADMIN" id="admin">ADMINISTRADOR</option>
              <option value="COMUN" id="comun">COMÚN</option>
            </select>
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
        <button type="button" class="btn btn-primary" onclick="editarUsuario()">Guardar</button>
      </div>
    </div>
  </div>
</div>