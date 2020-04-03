<div id="logProfesor">
  <div class="container">
     <div class="card" id="asignatura">
                  <div class="face face1">
                      <div  class="content">
                          <img src="https://image.flaticon.com/icons/svg/401/401708.svg">
                          <h3>Asignaturas</h3>
                      </div>
                  </div>
                  <div class="face face2">
                      <div class="content">
                          <h3>Asignaturas</h3>
                          <p>Texto descriptivo </p>
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
                          <p>Texto descriptivo </p>
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
                          <p>Texto descriptivo </p>
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
                          <p>Texto descriptivo </p>
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
                          <p>Texto descriptivo </p>
                            <!--form method="post" action="<?=base_url()?>index.php/cambio">
                               <button type="submit">Entrar</button-->
                               <a href="<?=base_url()?>index.php/desempeno">Entrar</a>
                            <!--/form-->
                      </div>
                  </div> 
     </div> 

     <div class="card" id="notificacion">
                  <div class="face face1">
                      <div class="content">
                          <img src="https://www.flaticon.es/premium-icon/icons/svg/2073/2073093.svg">
                          <h3>Notificacion</h3>
                      </div>
                  </div>
                  <div class="face face2">
                      <div class="content">
                          <h3>Notificacion</h3>
                          <p>Texto descriptivo </p>
                            <!--form method="post" action="<?=base_url()?>index.php/cambio">
                               <button type="submit">Entrar</button-->
                               <a href="<?=base_url()?>index.php/notificacion">Entrar</a>
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

    var titulo = "titulo"
    var contenido = "contenido"
    var url = "http://localhost/TecWeb/index.php/nota"
    mensajePush(titulo, contenido, url);
    //mensajePush(titulo2, contenido, url);
  } else {
    console.log("isNotPushSupported");
  }
});




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