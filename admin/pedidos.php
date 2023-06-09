<?php 
session_start();
include("../php/includes_user.php");
include("../php/functions_admin.php");
if(isset($_SESSION['loggedin']) && $_SESSION['rol'] == 1){ 
    $pagina_actual = (isset($_GET['pagina'])) ? $_GET['pagina'] : 1;
    $pagina = array("pagina" => $pagina_actual,
                    "lista" => (isset($_GET['buscar'])) ? $_GET['buscar'] : 0,
                    "tipo" => ($_GET['buscar'] == 1) ? "completos" : "cancelados");
?>
<style>
.hover_sha_orange:hover{box-shadow: 0 0 5px orange}
.hover_sha_green:hover{box-shadow: 0 0 5px green}
.hover_sha_red:hover{box-shadow: 0 0 5px red}
#pedidos {
  padding:10px 0;
  & a {
    margin-bottom:10px;
    display:inline-block;
    color:black;
    border:.1px solid #999;
    padding:9px 20px;
    background: #f2f2f2;
    border-radius:2px;
    cursor: pointer;
    transition: ease 1s all;
  }
  & a:hover {
    background: #e5e5e5;
  }
}
</style>
<body>
    <div id="contenido">
        <div id="pedidos">
          <a class="hover_sha_orange" href="?lista=pendientes">PENDIENTES</a>
          <a class="hover_sha_green" href="?lista=completos">COMPLETOS</a>
          <a class="hover_sha_red" href="?lista=cancelados">CANCELADOS</a>
          <div id="listado">
          <?=mostrarLista((isset($_GET['lista']) ? $_GET['lista'] : "pendientes"))?>
          </div>
        </div>
    </div>
</body>
</html>
<?php } else {header("location: ../index.php");}?>

<!-- JS PARA ACTULIZAR EL LISTADO DE PENDIENTES -->
<?php if(!isset($_GET['lista']) || $_GET['lista'] == "pendientes"){ ?> 
<script>
setInterval(function() {
    $("#listado").load("./PEDIDOS/listado.php?lista=pendientes");
},3000);
</script>
<?php } ?>


<?php
function mostrarLista($lista){
  switch($lista){
    case "pendientes": include("./PEDIDOS/listado.php");
    break;
    case "completos": include("./PEDIDOS/listado.php");
    break; 
    case "cancelados": include("./PEDIDOS/listado.php");
  }
}

?>