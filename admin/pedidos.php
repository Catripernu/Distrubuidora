<?php 
session_start();
include("../php/includes_user.php");
include("../php/functions_admin.php");
if(isset($_SESSION['loggedin']) && $_SESSION['rol'] == 1){ ?>
<style>
#pedidos {
    & .contenido {
        display: none;
        padding:20px 0;
        justify-content: center;
        align-items: center;
    }
}
.pendientes__lista {
    margin:10px 0;
  display:flex;
  align-items: center;
  justify-content:space-around;
  padding:10px;
  & .telefono {display:none}
}
.back_orange {background-color: orange;}
.hover_sha_orange:hover{box-shadow: 0 0 5px orange}
.hover_sha_green:hover{box-shadow: 0 0 5px green}
.hover_sha_red:hover{box-shadow: 0 0 5px red}
</style>
<body>
    <div id="contenido">
        <div id="pedidos">
            <button class="btn_default hover_sha_orange" onclick="mostrarContenido(1)">PENDIENTES</button>
            <button class="btn_default hover_sha_green" onclick="mostrarContenido(2)">COMPLETOS</button>
            <button class="btn_default hover_sha_red" onclick="mostrarContenido(3)">CANCELADOS</button>
            <div id="contenido1" class="contenido">
            </div>
            <div id="contenido2" class="contenido">
                <?=pedidos(1)?>
            </div>
            <div id="contenido3" class="contenido">
                <?=pedidos(2)?>
            </div>
        </div>
    </div>
</body>
</html>
<?php } else {header("location: ../index.php");} ?>

<script>
// Mostrar el contenido del Botón 1 al cargar la página
window.onload = function() {
    mostrarContenido(1);
    pendientes();
};
function mostrarContenido(numero) {
    // Ocultar todos los divs
    var divs = document.getElementsByClassName('contenido');
    for (var i = 0; i < divs.length; i++) {
        divs[i].style.display = 'none';
    }
    // Mostrar el div correspondiente al botón seleccionado
    var contenido = document.getElementById('contenido' + numero);
    contenido.style.display = 'flex';
}
function pendientes(){
    $.ajax({
        url: "./PEDIDOS/obtener_pendientes.php", // Ruta al archivo PHP que contiene la función obtenerRegistrosEnTiempoReal()
        type: "GET",
        success: function(response) {
            $("#contenido1").html(response); // Muestra los registros en un elemento con el ID "registros"
        }
    });
}   
setInterval(pendientes, 5000);
</script>