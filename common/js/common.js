// Modal usuario 
$("#modal_usuario").on("show.bs.modal", function(event) {
  var button = $(event.relatedTarget) // Botón que activé el modal
  $("#id_user").val(button.data('id'));
})
$("#modal_usuario").on("hide.bs.modal", function(event) {
  $("#pass_repeat").val('')
  $('#n_pass').val('') 
  $("#pass").val('')
  $("#pass_repeat").removeClass('is-valid');
  $("#pass_repeat").removeClass('is-invalid');
})
const cambiarPass = (root) => {
  if( $("#pass_repeat").val() == $('#n_pass').val() && $("#pass").val()!= ''){
    data = {
      idUsuario: $("#id_user").val(),
      pass: $("#pass").val(),
      newPass: $("#n_pass").val()
    }
    $.ajax({
      data,
      url: root+"controllers/cambiarPass.php",
      type: "POST",
      dataType: "JSON",
      success: function (response) {
        if(response.ok){
          Swal.fire({
            icon: 'success',
            title: '¡ÉXITO!',
            text: 'La contraseña fue cambiada exitosamente',
          })
        }else{
          Swal.fire({
            icon: 'error',
            title: '¡UPPS! ',
            text: response.msg,
          })
        }
      },
      error: function(err){
        console.log(err)
      }
    })
    console.log(data)
  }else{
    $("#btn_cambiar").prop("disabled", true);
  }
}
const showPass = (curr) => {
  if($(curr).data('visible') == 'true'){
    $(curr).data('visible','false');
    const idInput = $(curr).data('obj');
    $('#'+idInput).attr('type','password');
    $(curr).html('<i class="fas fa-eye"></i>');
  }else{
    $(curr).data('visible','true');
    const idInput = $(curr).data('obj');
    $('#'+idInput).attr('type','text');
    $(curr).html('<i class="fas fa-eye-slash"></i>');
  }
}

$("#pass_repeat").on('keyup', (e)=>{
  if(e.target.value != $('#n_pass').val()){
    $(e.target).addClass('is-invalid');
    $("#btn_cambiar").prop("disabled", true);
  }else{
    $(e.target).removeClass('is-invalid');
    $(e.target).addClass('is-valid');
    $("#btn_cambiar").prop("disabled", false);
  }
  if(e.target.value == ''){
    $(e.target).removeClass('is-valid');
    $(e.target).removeClass('is-invalid');  
  }
})

// logout common
const logout = (root) =>{
  $(document).Toasts('create', {
    title: 'Cerrando sesión ...'+'&nbsp;',
    close: false,
    autoremove: true,
    autohide: true,
    delay: 1500,
    class: 'bg-warning p-2 mt-2 mr-2',
    body: 'Saliendo de la aplicación ...'
  })
  setTimeout(l(root),3300)
}
const l = (root) => {
  $.ajax({
    data:{},
    url: root+"controllers/logout.php",
    type: "POST",
    dataType: "JSON",
    success: function (response) {
      if(response.ok){
        window.location.href = root;
      }else{
        $(document).Toasts('create', {
          title: 'ERROR AL CERRAR SESIÓN'+'&nbsp;',
          close: false,
          autoremove: true,
          autohide: true,
          delay:3000,
          class: 'bg-danger p-2 mt-2 mr-2',
          body: 'No se pudo cerrar la sesión, intente de nuevo'
        })
      }
    },
    error: function (err){
      console.log(err);
    }
  })
}

const set_logo = async (self, root) => {
  const { value: file } = await Swal.fire({
    title: 'Seleccione una imagen',
    text: "El tamaño recomendado es de 200x200 [px]",
    input: 'file',
    inputAttributes: {
      'accept': 'image/*',
      'aria-label': 'Upload your profile picture'
    }
  })
  if (file) {
    const reader = new FileReader()
    reader.onload = (e) => {
      Swal.fire({
        title: 'Su logo será...',
        imageUrl: e.target.result,
        imageAlt: 'Logo',
        showCancelButton: true,
        confirmButtonText: 'Ok, guardar'
      }).then((result) => {
        if(result.isConfirmed){
          console.log('Debemos guardar imagen')
          const id = $(self).data('id');
          const formData = new FormData();
          formData.append('logo', file, file.name);
          formData.append('id', id);
          $.ajax({
            url: root+"controllers/imageLogo.php",
            type: 'POST',
            data: formData,
            processData: false,
            contentType: false,
            dataType: 'JSON',
            success: function(response) {
              if(response.status === 'ok'){
                $(document).Toasts('create', {
                  title: 'Agregado correctamente... &nbsp;',
                  close: false,
                  autoremove: true,
                  autohide: true,
                  class: 'bg-success p-2 mt-2 mr-2',
                  body: 'Logo agregado correctamente'
                })
              }
            },
            error: function(error) {
              console.error('Error al enviar la imagen', error);
            }
          });
        }
      })
    }
    reader.readAsDataURL(file)
  }
}