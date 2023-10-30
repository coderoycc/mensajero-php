$(document).ready(function () {
  // $('#fecha').datetimepicker({
  //   format: 'DD/MM/YYYY',
  // });
  $('#horaInicio').datetimepicker({
    format:'HH:mm',
    minTime: '04:00',
    maxTime: '23:00',
    stepping: 15
  });

  $('.colorHexa').colorpicker()
  $('.colorHexa').on('colorpickerChange', function(event) {
    $('.colorHexa .fa-square').css('color', event.color.toString());
  })

  $("#add_cita").submit((e)=>{
    e.preventDefault();
    const data = $("#add_cita").serialize();
    console.log(data)
    $.ajax({
      url: '../controllers/addMensaje.php',
      type: 'POST',
      data: data,
      dataType: 'JSON',
      success: function (response) {
        if(response.ok){
          Swal.fire({
            icon: 'success',
            title: 'Mensaje programado correctamente',
            showConfirmButton: false,
            timer: 1500
          })
          setTimeout(() => {
            window.location.href = './';
          }, 2200)
        }else{
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
})