<div class="modal fade" id="modal-eliminar-paciente" style="display: nonde;" aria-modal="true"
  role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title text-center">Eliminar Paciente</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">×</span>
        </button>
      </div>
      <div class="modal-body">
        <p>¿Está seguro que desea eliminar este paciente?</p>
      </div>
      <div class="modal-footer justify-content-between">
        <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
        <button type="button" class="btn btn-danger" data-dismiss="modal" onclick="eliminarPaciente()"><i class="fas fa-trash"></i> Eliminar</button>
      </div>
    </div>
  </div>
</div>