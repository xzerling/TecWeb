<div id="evaluaciones" name="evaluaciones">
                          <? if(isset($evaluaciones)){ ?>
                          <?$i=0;foreach($evaluaciones as $row):?>
                          <div id="<?=$i?>">
                            <input type="hidden" id="id<?=$i?>" value="<?=$row['id']?>" readonly> 
                            <input type="hidden" id="nombre<?=$i?>" value="<?=$row['nombre']?>" readonly> 
                            <input type="hidden" id="fecha<?=$i?>" value="<?=$row['fecha']?>" readonly> 
                            <input type="hidden" id="dAntes<?=$i?>" value="<?=$row['diasAntes']?>" readonly> 
                            <input type="hidden" id="dDespues<?=$i?>" value="<?=$row['diasDespues']?>" readonly> 
                          </div>
                          <?$i++;endforeach;?>
                          <?}?>
                        
                        </div>
<div id="logProfesor">
  <div class="container">
     <div class="card" id="asignatura">
                  <div class="face face1">
                      <div  class="content">
                        <input type="hidden" id="correo" name="correo" value="<?=$correo?>" readonly>
                          <img src="https://image.flaticon.com/icons/svg/401/401708.svg">
                          <h3>Asignaturas</h3>
                      </div>
                  </div>
                  <div class="face face2">
                      <div class="content">
                          <h3>Asignaturas</h3>
                          <p>Ver asignaturas general </p>
                            <!--form method="post" action="<?=base_url()?>index.php/cambio">
                               <button type="submit">Entrar</button-->
                               <a href="<?=base_url()?>index.php/instanciaAsignatura">Entrar</a>
                            <!--/form-->                          
                      </div>
                  </div> 
     </div>

     <div class="card" id="evaluacion">
                  <div class="face face1">
                      <div class="content">
                          <img src="https://image.flaticon.com/icons/svg/1312/1312253.svg">
                          <h3>Evaluacion</h3>
                      </div>
                  </div>
                  <div class="face face2">
                      <div class="content">
                          <h3>Evaluacion</h3>
                          <p>Ver evaluaciones general </p>
                            <!--form method="post" action="<?=base_url()?>index.php/cambio">
                               <button type="submit">Entrar</button-->
                               <a href="<?=base_url()?>index.php/evaluacion">Entrar</a>
                            <!--/form-->                         
                      </div>
                  </div> 
     </div>

     <div class="card" id="notasCARD">
                  <div class="face face1">
                      <div class="content">
                          <img src="https://image.flaticon.com/icons/svg/2228/2228716.svg">
                          <h3>Notas</h3>
                      </div>
                  </div>
                  <div class="face face2">
                      <div class="content">
                         <h3>Notas</h3>
                          <p>Ver notas general </p>
                               <a href="<?=base_url()?>index.php/nota">Entrar</a>
                      </div>
                  </div> 
     </div>
     
  </div>
</div>

   <br>

<div id="logProfesor">
  <div class="container">
     
     <div class="card" id="observacion">
                  <div class="face face1">
                      <div class="content">
                          <!--<img src="https://image.flaticon.com/icons/svg/490/490357.svg">-->
                          <img src="https://image.flaticon.com/icons/svg/1069/1069159.svg">
                          <h3>Observación</h3>
                      </div>
                  </div>
                  <div class="face face2">
                      <div class="content">
                          <h3>Observación</h3>
                          <p>Ver observaciones </p>
                            <!--form method="post" action="<?=base_url()?>index.php/cambio">
                               <button type="submit">Entrar</button-->
                               <a href="<?=base_url()?>index.php/observacion">Entrar</a>
                            <!--/form-->                         
                      </div>
                  </div> 
     </div>

     <div class="card" id="desempeno">
                  <div class="face face1">
                      <div  class="content">
                          <img src="https://image.flaticon.com/icons/svg/1740/1740461.svg">
                          <h3>Desempeño</h3>
                      </div>
                  </div>
                  <div class="face face2">
                      <div class="content">
                          <h3>Desempeño</h3>
                          <p>Ver desempeño general </p>
                            <!--form method="post" action="<?=base_url()?>index.php/cambio">
                               <button type="submit">Entrar</button-->
                               <a href="<?=base_url()?>index.php/desempeno">Entrar</a>
                            <!--/form-->
                      </div>
                  </div> 
     </div> 

     <div class="card" id="administracion">
                  <div class="face face1">
                      <div class="content">
                          <img src="https://image.flaticon.com/icons/svg/2345/2345403.svg">
                          <h3>Administración</h3>
                      </div>
                  </div>
                  <div class="face face2">
                      <div class="content">
                          <h3>Administración</h3>
                          <p>Crear profesores </p>
                            <!--form method="post" action="<?=base_url()?>index.php/cambio">
                               <button type="submit">Entrar</button-->
                               <a href="<?=base_url()?>index.php/administracion">Entrar</a>
                            <!--/form-->
                      </div>
                  </div> 
     </div>      
  </div>
</div>  



<script src="https://cdn.onesignal.com/sdks/OneSignalSDK.js" async=""></script>
<script>
  var OneSignal = window.OneSignal || [];
  OneSignal.push(function() {
    OneSignal.init({
      appId: "7f114f51-920e-4a37-b145-7866c7184c11",
    });
  });

  OneSignal.push(function() {
  /* These examples are all valid */
  var isPushSupported = OneSignal.isPushNotificationsSupported();
  if (isPushSupported) {
    console.log("isPushSupported");

    var titulo = "Bienvenido";
    var contenido = "Bienvenido al sistema de Tec Web";
    var url = "http://localhost/TecWeb/index.php";

    //mensajePush(titulo, contenido, url);

    comprobarNotificaciones();
    //mensajePushId(titulo2, contenido, url);
  } else {
    console.log("isNotPushSupported");
  }
});


function comprobarNotificaciones(){

  var titulo = "Bienvenido";
    var contenido = "Bienvenido al sistema de Tec Web";
    var url = "http://localhost/TecWeb/index.php";

    var correo = $("#correo").val();
    
    var evaluaciones = $("#evaluaciones");
    var largo = evaluaciones.length;
    console.log("largo: " + largo);

    //diaActual
    var d = new Date();
    console.log("date: " + d);
    var month = d.getMonth()+1;
    var day = d.getDate();
    var year = d.getFullYear();

    //var fechaActual = new Date(year, month, day);
    //console.log("fechaAct: " + fechaActual);

    var fechaFinalActual = d.getFullYear() + '-' +
    (month<10 ? '0' : '') + month + '-' +
    (day<10 ? '0' : '') + day;
    
    console.log("fechaFAC: " + fechaFinalActual);


    for (var i = 0; i < largo; i++) {
      var localId = $("#id"+i).val();
      var localNombre = $("#nombre"+i).val();
      var localFecha = $("#fecha"+i).val();
      var localDAntes = $("#dAntes"+i).val();
      var localDDespues = $("#dDespues"+i).val();
      
      var datee = new Date(localFecha);
      console.log("localD: "+datee);

      console.log(localId, localNombre, localFecha, localDAntes, localDDespues);

      var flag = calculoNotificacion(d, datee, localDAntes, localDDespues, localNombre);
      //hacerCalculo con estos y mostrarpush
    }
    //obtenerEvaluaciones(correo);
}

function calculoNotificacion(fechaFinalActual, localFecha, localDAntes, localDDespues, localNombre){

  const diffTime = Math.abs(localFecha - fechaFinalActual);
  const diffDays = Math.ceil(diffTime / (1000 * 60 * 60 * 24)); 
  console.log("diff: "+diffDays);

  if(fechaFinalActual > localFecha){
     console.log("mayor");
     if(diffDays >= localDDespues){
      console.log("evaluar");
      var titulo = "Recordatorio Calificar Evaluacion";
      var contenido = localNombre +" esta pendiente de evaluación";
      var url = "http://localhost/TecWeb/index.php/nota";

      mensajePush(titulo, contenido, url);
    }
  }else{
     console.log("menor");
    if(diffDays <= localDAntes){
      console.log("recordatorio evaluacion");
      var titulo = "Recordatorio Evaluacion";
      var contenido = "Asignatura: "+localNombre +" tiene pronta evaluación";
      var url = "http://localhost/TecWeb/index.php/evaluacion";

      mensajePush(titulo, contenido, url);
    }
  }

  /*if(diffDays >= 0){
    console.log("evaluar");
    var titulo = "Recordatorio Calificar Evaluacion";
    var contenido = localNombre +" esta pendiente de evaluación";
    var url = "http://localhost/TecWeb/index.php/nota";

    mensajePush(titulo, contenido, url);
  }
  else if(diffDays <= 0){
    console.log("recordatorio evaluacion");
    var titulo = "Recordatorio Evaluacion";
    var contenido = "Asignatura: "+localNombre +" tiene pronta evaluación";
    var url = "http://localhost/TecWeb/index.php/evaluacion";

    mensajePush(titulo, contenido, url);
  }*/
  if(isNaN(diffDays)){
    console.log("null");

    var titulo = "Bienvenido";
    var contenido = "Usted no posee recordatorios";
    var url = "http://localhost/TecWeb/index.php";

    mensajePush(titulo, contenido, url);
  }

}

function obtenerEvaluaciones(correo){
    var base_url = "<? echo base_url()?>";
    console.log("obtenerAlumnos");
    console.log(id);
    $.post(
      base_url+"index.php/nota/obtenerEvaluaciones",
      {correo:correo},
      function(url, data){
        //var html = $.parseHTML(data);
        //alert(url);
        var x = document.createElement('div');
          x.innerHTML = url;

        var nuevosAlumnos = x.querySelector('#listado').innerHTML;
        document.querySelector('#listado').innerHTML = nuevosAlumnos;
        
      }
    )
  }


function mensajePush(titulo, contenido, url){
var jsonBody = {
  "app_id": "7f114f51-920e-4a37-b145-7866c7184c11",
  "included_segments": ["All"],
  "url" : url,
  "headings": {
                "en": titulo
              },
  "contents": {
                "en": contenido
              }
  };
  var request = $.ajax({
      url: "https://onesignal.com/api/v1/notifications",
      headers: {
            'Authorization':'Basic NTFlYzllNzAtMWUwMy00YTc4LWI0MGYtNWMwNzlmM2IyN2Mz',
            'Content-Type':'application/json'
        },
      type: "POST",
      data: JSON.stringify(jsonBody),
      dataType: "json"
  });
  console.log(request);

    request.success(function(msg) {
      console.log("success");
    });

    request.error(function(jqXHR, textStatus ) {
      console.log( "Request failed: " + textStatus );

    });


}

function mensajePushId(id, titulo, contenido, url){
var jsonBody = {
  "app_id": "7f114f51-920e-4a37-b145-7866c7184c11",
  "included_segments": ["All"],
  "url" : url,
  "headings": {
                "en": titulo
              },
  "contents": {
                "en": contenido
              }
  };
  var request = $.ajax({
      url: "https://onesignal.com/api/v1/notifications",
      headers: {
            'Authorization':'Basic NTFlYzllNzAtMWUwMy00YTc4LWI0MGYtNWMwNzlmM2IyN2Mz',
            'Content-Type':'application/json'
        },
      type: "POST",
      data: JSON.stringify(jsonBody),
      dataType: "json"
  });
  console.log(request);

    request.success(function(msg) {
      console.log("success");
    });

    request.error(function(jqXHR, textStatus ) {
      console.log( "Request failed: " + textStatus );

    });


}

</script>