<div class="modal fade" id="modal-eliminar-usuario" style="display: none;" aria-modal="true"
  role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title text-center">Eliminar Usuario</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">×</span>
        </button>
      </div>
      <div class="modal-body">
        <p>¿Está seguro que desea eliminar al usuario <b id="nombreUser"></b>?</p>
      </div>
      <div class="modal-footer justify-content-between">
        <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
        <button type="button" class="btn btn-danger" data-dismiss="modal" onclick="eliminarUsuario()"><i class="fas fa-trash"></i> Eliminar</button>
      </div>
    </div>
  </div>
</div>