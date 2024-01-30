$(document).ready(function(){
  $("#modal-eliminar-usuario").on("show.bs.modal", function(e){
    const idUsuario = $(e.relatedTarget).data("id");
    $("#idUsuario").val(idUsuario);
    $("#nombreUser").html($(e.relatedTarget).data("nombre"));
  })
  $("#modal-resetear-password").on("show.bs.modal", function(e){
    const idUsuario = $(e.relatedTarget).data("id");
    $("#idUsuario").val(idUsuario);
    $("#userResetPass").html($(e.relatedTarget).data("nombre"));
  })
  $("#modal-editar-usuario").on("show.bs.modal", async function(e){
    const idUsuario = $(e.relatedTarget).data("id");
    const res = await peticion('./controllers/obtenerUsuario.php', {id:idUsuario})
    console.log(idUsuario)
    if(res.ok){
      $("#user").val(res.data.usuario);
      $("#nombre").val(res.data.nombres);
      $("#idUsuario_edit").val(res.data.idUsuario);
      res.data.rol === "ADMIN" ? $("#admin").prop("selected", true) : $("#comun").prop("selected", true);
      $("#celular").val(res.data.celular)
    }else{
      alert('Ocurrio un error')
      console.log(res)
    }
  })

  $("#modal-eliminar-usuario").on('hide.bs.modal', function () {
    $("#idUsuario").val("");
  })
  $("#modal-resetear-password").on('hide.bs.modal', function () {
    $("#idUsuario").val("");
  })
  $("#modal-editar-usuario").on('hide.bs.modal', function () {
    $("#idUsuario").val("");
  })
})

async function eliminarUsuario(){
  const res = await peticion('./controllers/eliminarUsuario.php', {id:$("#idUsuario").val()})
  if(res){
    if(res.ok){
      mensajeSwal('Usuario eliminado', 'success')
      setTimeout(() => {
        window.location.reload();
      }, 1600);
    }else{
      console.log(res);
    }
  }else{
    mensajeSwal('Ocurrio un error', 'error')
  }
}
async function resetearPass(){
  const res = await peticion('./controllers/resetearPass.php', {id:$("#idUsuario").val()})
  if(res){
    if(res.ok){
      mensajeSwal('Contraseña restablecida', 'success')
    }else{
      console.log(res);
    }
  }else{
    mensajeSwal('Ocurrio un error', 'error')
  }
}

async function editarUsuario(){
  const data = $("#formEditarUsuario").serialize();
  console.log(data)
  const res = await peticion('./controllers/editarUsuario.php',data)
  if(res.ok){
    mensajeSwal('Usuario actualizado', 'success')
    setTimeout(() => {
      window.location.reload();
    }, 1500)
  }else{
    console.log(res)
  }
}
async function agregarUsuario(){
  const data = $("#formNuevoUsuario").serialize();
  // console.log(data)
  const res = await peticion('./controllers/agregarUsuario.php', data)
  if(res.ok){
    mensajeSwal('Usuario agregado', 'success')
    
    setTimeout(() => {window.location.reload();}, 1500)
  }else{
    mensajeSwal('Ocurrio un error', 'error')
    console.log(res)
  }
}


async function peticion(url, datos){
  try {
    const response = await $.ajax({
      data: datos,
      url:url,
      type:"POST",
      dataType:"json",
    })
    return response;
  } catch (error) {
    console.log(error);
    return false;
  }
}

function mensajeSwal(mensaje, icon){
  Swal.fire({
    icon,
    title: mensaje,
    showConfirmButton: false,
    timer: 1300
  })
}