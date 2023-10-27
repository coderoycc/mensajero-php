<div class="modal fade" id="modal-resetear-password" style="display: none;" aria-modal="true"
  role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title text-center">Resetear contraseña del usuario</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">×</span>
        </button>
      </div>
      <div class="modal-body">
        <p>La contraseña del usuario <b id="userResetPass"></b> se restablecerá a la contraseña por defecto. <b>¿Desea continuar?</b></p>
      </div>
      <div class="modal-footer justify-content-between">
        <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
        <button type="button" class="btn btn-warning" data-dismiss="modal" onclick="resetearPass()"><i class="fas fa-lock"></i> Restablecer</button>
      </div>
    </div>
  </div>
</div>