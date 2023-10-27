//login
$("#form_login").on("submit",function(e){
  e.preventDefault();
  const data = $("#form_login").serialize();
  $.ajax({
    data,
    url: "./controllers/login.php",
    type: "POST",
    dataType: "JSON",
    success: function (response) {
      if(response.ok){
        window.location.href = "./";
      }else{
        $(document).Toasts('create', {
          title: 'ERROR CON LAS CREDENCIALES'+'&nbsp;',
          close: false,
          autoremove: true,
          autohide: true,
          delay:3000,
          class: 'bg-danger p-2 mt-2 mr-2',
          body: 'Usuario o contraseña incorrectos'
        })
      }
    },
    error: function (err){
      console.log(err);
    }
  })
});
$("#show_pass").click((e)=>{
  const pp = $(e.currentTarget)
  console.log(pp.data('visible'))
  if(pp.data('visible')==false){
    pp.data('visible',true)
    pp.html('<i class="fas fa-lock-open"></i>')
    $("#pass").attr('type','text')
  }else{
    pp.data('visible',false)
    pp.html('<i class="fas fa-lock"></i>')
    $("#pass").attr('type','password')
  }
})

