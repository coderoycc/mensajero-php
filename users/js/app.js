$(document).ready(function () {
  $('#datemask2').inputmask('dd/mm/yyyy', { 'placeholder': 'dd/mm/yyyy' })
  $('#fecha_nac').datetimepicker({
    format: 'L'
  });

  $("#add_paciente").submit(async (e) => {
    e.preventDefault();
    $("#btn-guardar").attr('disabled', true)
    const formData = $("#add_paciente").serialize();

    await peticionForms("AGREGAR PACIENTE", formData, "addService");    
  })

  $("#update_paciente").submit(async (e) => {
    e.preventDefault();
    $("#btn-update").attr('disabled', true)
   
    const formData = $("#update_paciente").serialize();
    await peticionForms("ACTUALIZAR PACIENTE", formData, "updateService");
  })

  $("#modal-eliminar-paciente").on('show.bs.modal', function (event) {
    var id = $(e.relatedTarget).data().id;
    $("#idEliminar").val(id);
  })
  
})

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
async function peticionForms(accion, formData, servicio){
  $.ajax({
    data: formData,
    url: "./services/"+servicio+".php",
    type: "POST",
    dataType: "JSON",
    success: function (response) {
      if (response.code) {
        show_toast(accion, response.message, "bg-success");
        // setTimeout(()=>window.location.href = "./", 1700);
      } else {
        show_toast(accion, response.message, "bg-danger");
      }
      console.log(response)
    },
    error: function (error) {
      console.log(error)
    }
  })
}

async function eliminarPaciente(){
  const idPaciente = $("#idEliminar").val();
  console.log(idPaciente)
  // await peticionForms("ELIMINAR PACIENTE", {idPaciente}, "deleteService");
}
