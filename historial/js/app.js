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
function calcular_imc(peso, talla) {
  var tallam = parseInt(talla);
  tallam = tallam / 100;
  var imc = peso / (tallam * tallam)
  // console.log(imc);
  imc = imc.toFixed(2);
  if (imc < 18.5) {
    $("#imc_info").html(contentIMC(imc, 'danger', 'Muy bajo de lo normal'));
  } else if (imc >= 18.5 && imc <= 24.9) {
    $("#imc_info").html(contentIMC(imc, 'success', 'Valores normales para el peso y talla'))
  } else if (imc >= 25 && imc <= 29.9) {
    $("#imc_info").html(contentIMC(imc, 'warning', 'Sobrepeso'))
  } else if (imc >= 30) {
    $("#imc_info").html(contentIMC(imc, 'danger', 'Obesidad'));
  }
}

function contentIMC(imc, color, mensaje){
  return `
  <div class="alert alert-${color} alert-dismissible" style="max-width: 350px;margin: 0 auto;">
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
    <h5><i class="icon fas fa-exclamation-triangle"></i> <b>IMC: &nbsp;&nbsp;${imc}</b> </h5>
    <h6> Estado: <b>${mensaje}</b></h6>
  </div>
  `;
}

function imprimirReceta(idConsulta){
  var form = document.createElement("form");
  form.setAttribute("method", "post")
  form.setAttribute("action", "../filesGenerate/receta.php")
  form.setAttribute("target", "_blank")
  form.innerHTML = `
    <input type="hidden" name="idConsulta" value="${idConsulta}">
  `;
  document.body.appendChild(form);
  form.submit();
  form.remove();
}

function enviarDatos(e){
  e.preventDefault();
  const formData = $("#edit_consulta").serialize();
  console.log(formData);
  // $.ajax({
  //   data: formData,
  //   url: "../controllers/editConsulta.php",
  //   type: "POST",
  //   dataType: "JSON",
  //   success: function (response) {
  //     if(response.ok){
  //       Swal.fire({
  //         icon:'success',
  //         title: 'Se guardaron los cambios',
  //         showConfirmButton: false,
  //         timer: 1300
  //       })
  //       setTimeout(()=>{window.location.href = "../pacientes/"},1700);
  //     }else{
  //       Swal.fire({
  //         icon:'error',
  //         title: 'Ocurrio un error',
  //         showConfirmButton: false,
  //         timer: 1300
  //       })
  //     }
  //   },
  //   error: function (response) {
  //     console.log(response)
  //   }
  // })
}
