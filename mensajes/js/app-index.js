$(document).ready(async function () {
  
  try {
    let citas = await peticionCitas();
    // console.log(citas)
    function ini_events(ele) {
      ele.each(function () {
        var eventObject = {
          title: $.trim($(this).text()) 
        }
        $(this).data('eventObject', eventObject)
        $(this).draggable({
          zIndex: 1070,
          revert: true, // will cause the event to go back to its
          revertDuration: 0  //  original position after the drag
        })
      })
    }
  
    ini_events($('#external-events div.external-event'))
    var Calendar = FullCalendar.Calendar;
    var calendarEl = document.getElementById('calendar');
    var calendar = new Calendar(calendarEl, {
      headerToolbar: {
        left: 'prev,next today',
        center: 'title',
        right: 'dayGridMonth,timeGridWeek,timeGridDay'
      },
      locale: 'es',
      height: 670,
      navLinks: true,
      themeSystem: 'bootstrap',
      //Random default events
      events: citas,
      editable: false,
      droppable: false,
      eventClick: function(info) {
        $('.toast').remove();
        var eventObj = info.event;
        let hora = info.event.start
        hora = `${hora.getHours()>9?'':'0'}${hora.getHours()}:${hora.getMinutes()>9?'':'0'}${hora.getMinutes()}`
        $(document).Toasts('create', {
          title: 'Detalles del mensaje programado',
          autohide: true,
          icon: 'fas fa-clock',
          delay: 2900,
          class:'bg-primary toast-center',
          body: '<b>Mensaje:</b> '+eventObj.title+'<br>'+'<b>hora:</b> '+hora,
          closePrevious: true
        })
        
      },
    });
  
    calendar.render();
  } catch (error) {
    console.log(error);
    alert("Error al cargar mensajes, Mas info en consola")
  }

})

async function peticionCitas() {
  const id = $("#id_user").val();
  try {
    const response = await $.ajax({
      data: { id },
      url: '../controllers/getMensajes.php',
      type: 'POST',
      dataType: 'json', 
    })
    if(response.ok){
      let citas = [];
      response.data.forEach(cita => {
        let fechaPartes = cita.fecha.split("-");
        let horaPartesI = cita.horaInicio.split(":");
        let horaPartesF = cita.horaFin.split(":");
        citas.push({
          title: cita.mensaje,
          start: new Date(fechaPartes[0], fechaPartes[1] - 1, fechaPartes[2], horaPartesI[0], horaPartesI[1]),
          end: new Date(fechaPartes[0], fechaPartes[1] - 1, fechaPartes[2], horaPartesF[0], horaPartesF[1]),
          allDay: false,
          backgroundColor: cita.color,
          borderColor: cita.color
        })
      });
      return citas;
    }else{
      return [];
    }
  } catch (error) {
    console.log(error);
  }
}
