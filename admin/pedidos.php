<?php 
session_start();
include("../php/includes_user.php");
include("../php/functions_admin.php");
if(isset($_SESSION['loggedin']) && $_SESSION['rol'] == 1){ 
    $pagina_actual = (isset($_GET['pagina'])) ? $_GET['pagina'] : 1;
    $pagina = array("pagina" => $pagina_actual,
                    "lista" => (isset($_GET['buscar'])) ? $_GET['buscar'] : 0,
                    "tipo" => ($_GET['buscar'] == 1) ? "completos" : "cancelados");
  
  $prueba = '<div class="aviso"></div>';
  if($prueba){
    echo $prueba;
  }
?>
<script>

</script>
<style>
.listado_pedidos {margin:20px 0}
.listado_pedidos a {
        width: 100%;
        margin:2px 0;
        transition: ease 1s;
        padding:10px 0;
        display:flex;
        justify-content:space-around;
        align-items: center;
    }
.listado_pedidos a div {padding:0 10px;}


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
 
  var intervalID; // Variable para almacenar el ID del intervalo
  // Función para cargar el contenido cada 5 segundos
  function cargarContenido(boton,pagina,lista) {
    $.ajax({
      type: 'GET',
      url: './PEDIDOS/listado_pedidos.php',
      data: { boton: boton, pagina: pagina, lista: lista },
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
  $(document).ready(function() { 
  $('#pendientes,#completos,#cancelados').click(function(){
    var load = 0
    $('.aviso').html("boton");
    var botonID = $(this).attr('id');
    var array = [botonID,<?=$pagina['pagina']?>,<?=$pagina['lista']?>]
    if(array[0] == "pendientes"){
      cargarContenido("pendientes",false,false)
      iniciarActualizacion()
    } else {
      detenerActualizacion()
      cargarContenido(array[0],array[1],array[2])
    }
  })  
});

</script>