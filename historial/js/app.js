$(document).ready(()=>{
  if(Number($("#talla").val()) > 0 && Number($("#peso").val()) > 0){
    calcular_imc($("#peso").val(), $("#talla").val());
  }

})
$("#peso").on('change', function () {
  if(Number($("#talla").val()) > 0 && Number($("#peso").val()) > 0){
    calcular_imc($("#peso").val(), $("#talla").val());
  }
})
$("#talla").on('change', function () {
  if(Number($("#talla").val()) > 0 && Number($("#peso").val()) > 0){
    calcular_imc($("#peso").val(), $("#talla").val());
  } 
})


$(document).on('show.bs.modal', '#modal_eliminar_msg', (e) => {
  const caso = e.relatedTarget.dataset.caso;
  const idMensaje = e.relatedTarget.dataset.idmensaje;
  console.log(caso, idMensaje)
  $("#modal_idmsj").val(idMensaje);
  const msg = caso == '0' ? 'El mensaje se eliminará' : 'Solicitud fuera de plazo, puede que el mensaje aún se envie';
  const cadena = `<i class="fa fa-comment-dots"></i> ${msg}`;
  $('#msg_notificacion').html(cadena);
})
$(document).on('hide.bs.modal', '#modal_eliminar_msg', () => {
  setTimeout(() => {
    $("#modal_idmsj").val(0);
    $('#msg_notificacion').html('');
  }, 900);
})

async function eliminar(){
  const res = await $.ajax({
    url: 'deletemsg.php',
    type: 'POST',
    data: {idMensaje: $("#modal_idmsj").val()},
    dataType: 'JSON'
  });
  if(res.status == 'success'){
    Swal.fire({
      position: "top-end",
      icon: "success",
      title: "Mensaje eliminado",
      showConfirmButton: false,
      timer: 1300
    });
    setTimeout(() => {
      location.reload();
    }, 1330);
  }else{
    Swal.fire({
      position: "top-end",
      icon: "danger",
      title: "Ocurrió un error al eliminar",
      showConfirmButton: false,
      timer: 1400
    });
  }
}