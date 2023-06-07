<?php 
session_start();
include("../php/includes_user.php");
include("../php/functions_admin.php");
if(isset($_SESSION['loggedin']) && $_SESSION['rol'] == 1){ 
    $pagina = (isset($_GET['pagina'])) ? $_GET['pagina'] : 1; 
    ?>
<style>



.a_pendientes {background-color: orange}
.a_pendientes:hover {background: orangered}
.hover_sha_orange:hover{box-shadow: 0 0 5px orange}
.hover_sha_green:hover{box-shadow: 0 0 5px green}
.hover_sha_red:hover{box-shadow: 0 0 5px red}
@media (min-width: 700px){
    #pedidos {
        & button {padding:10px 20px}
        & .contenido a {border-radius:10px}
    }
}


</style>
<body>
    <div id="contenido">
        <div id="pedidos">
            <button id="pendientes">PENDIENTES</button>
            <button id="completos">COMPLETOS</button>
            <button id="cancelados">CANCELADOS</button>

            <div id="listado"></div>
        </div>
    </div>
</body>
</html>
<?php } else {header("location: ../index.php");}?>

<script>
$(document).ready(function() {
  var intervalID; // Variable para almacenar el ID del intervalo
  // Función para cargar el contenido cada 5 segundos
  function cargarContenido(boton) {
    $.ajax({
      type: 'GET',
      url: './PEDIDOS/listado_pedidos.php',
      data: { boton: boton },
      success: function(response) {
        $('#listado').html(response);
      }
    });
  }
  // Función para iniciar la actualización automática cada 5 segundos
  function iniciarActualizacion() {
    intervalID = setInterval(function() {cargarContenido("pendientes");}, 2000);
  }
  // Función para detener la actualización automática
  function detenerActualizacion() {
    clearInterval(intervalID);
  }
  // Clic en el botón 1
  $('#pendientes').click(function() {
    cargarContenido("pendientes"); // Carga el contenido inmediatamente
    iniciarActualizacion(); // Inicia la actualización automática
  });
  // Clic en el botón 2 y botón 3
  $('#completos, #cancelados').click(function() {
    var botonID = $(this).attr('id');
    detenerActualizacion(); // Detiene la actualización automática
    cargarContenido(botonID);
  });
});

</script>