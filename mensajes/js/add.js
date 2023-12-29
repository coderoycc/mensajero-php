let validateForm = false;
$(document).ready(function () {
  $('#horaInicio').datetimepicker({
    format: 'HH:mm',
    minTime: '04:00',
    maxTime: '23:00',
    stepping: 15
  });

  $('.colorHexa').colorpicker()
  $('.colorHexa').on('colorpickerChange', function (event) {
    $('.colorHexa .fa-square').css('color', event.color.toString());
  })

  $("#add_cita").submit((e) => {
    e.preventDefault();
    if (!validateForm) {
      return;
    }
    const data = $("#add_cita").serialize();
    console.log(data)
    $.ajax({
      url: '../controllers/addMensaje.php',
      type: 'POST',
      data: data,
      dataType: 'JSON',
      success: function (response) {
        if (response.ok) {
          Swal.fire({
            icon: 'success',
            title: 'Mensaje programado correctamente',
            showConfirmButton: false,
            timer: 1500
          })
          setTimeout(() => {
            window.location.href = './';
          }, 2200)
        } else {
          console.log(response)
          Swal.fire({
            icon: 'error',
            title: 'Ocurrió un error',
            showConfirmButton: false,
            timer: 1500
          })
        }
      },
      error: function (error) {
        console.log(error)
      }
    })
  })
});

$(document).on('change', '#fecha', (e) => {
  const fecha = new Date(e.target.value);
  fecha.setDate(fecha.getDate() + 1);
  const hoy = new Date();
  hoy.setHours(0, 0, 0, 0);
  console.log(hoy, fecha)
  if (fecha.getTime() < hoy.getTime()) {
    Swal.fire({
      icon: 'error',
      title: 'La fecha no puede ser menor a la fecha actual',
      showConfirmButton: false,
      timer: 1500
    })
    $('#fecha').val('');
  } else {
    validateForm = true;
    $("#checkDiaAntes").attr('disabled', false)
  }

  // verificamos si es hoy
  if (esHoy(hoy, fecha)) {
    // dehabilitamos recordatorio de un dia antes
    $("#checkDiaAntes").prop('checked', false)
    $("#checkDiaAntes").attr('disabled', true)
  }

})
$(document).on('input', '#hora', (e) => {
  const hora = e.target.value.split(':');
  const horaActual = new Date();
  const fecha = $("#fecha").val() != '' ? new Date($("#fecha").val()) : new Date(); 
  fecha.setDate(fecha.getDate() + 1);
  const hoy = new Date();
  hoy.setHours(0, 0, 0, 0);
  if (hora.length > 1 && hora[1] != '') {
    if(esHoy(hoy, fecha)){
      console.log('es hoy')
      if(horaActual.getHours() > parseInt(hora[0])){
        $(document).Toasts('create', {
          title: 'Hora fuera de rango',
          autohide: true,
          icon: 'fas fa-clock',
          delay: 2900,
          class:'bg-danger',
          body: 'La hora no puede se menor a la actual',
          closePrevious: true
        })
        validateForm = false;
      }else if(horaActual.getHours() == parseInt(hora[0]) && horaActual.getMinutes() > parseInt(hora[1])){
        $(document).Toasts('create', {
          title: 'Hora fuera de rango',
          autohide: true,
          icon: 'fas fa-clock',
          delay: 2900,
          class:'bg-danger',
          body: 'La hora no puede ser mejor a la actual',
          closePrevious: true
        })
        validateForm = false;
      }else{
        validateForm = true;
      }
      // la hora es una hora menor a la hora actual
      console.log(horaActual.getHours() - 1, parseInt(hora[0]))
      if(horaActual.getHours() == parseInt(hora[0]) - 1){
        $("#checkHoraAntes").prop('checked', false)
        $("#checkHoraAntes").attr('disabled', true)
      }else{
        $("#checkHoraAntes").attr('disabled', false)
      }
    }
  }
})

/**
 * 
 * @param {Date} hoy 
 * @param {Date} fecha 
 */
function esHoy(hoy, fecha) {
  if (fecha.getDate() == hoy.getDate() && fecha.getMonth() == hoy.getMonth() && fecha.getFullYear() == hoy.getFullYear()) {
    return true;
  }
  return false;
}