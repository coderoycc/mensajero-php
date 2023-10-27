$(document).ready(function () {
  $("#modal-eliminar-paciente").on('show.bs.modal', function (event) {
    var id = $(event.relatedTarget).data().id;
    $("#idEliminar").val(id);
  })
})
async function eliminarPaciente(){
  const idPaciente = $("#idEliminar").val();
  console.log(idPaciente)
  $.ajax({
    data: {idPaciente},
    url: "./services/deleteService.php",
    type: "POST",
    dataType: "JSON",
    success: function (response) {
      if (response.code) {
        show_toast('ELIMINAR PACIENTE', response.message, "bg-success");
        setTimeout(()=>window.location.href = "./", 1700);
      } else {
        show_toast('ELIMINAR PACIENTE', response.message, "bg-danger");
      }
      $("#idEliminar").val()
    },
    error: function (error) {
      console.log(error)
    }
  })
}
function show_toast(title, message, clss) {
  $(document).Toasts('create', {
    title: title+'&nbsp;',
    close: false,
    autoremove: true,
    autohide: true,
    class: clss+' p-2 mt-2 mr-2',
    body: message
  })
}