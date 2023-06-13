<?php 
session_start();
include("../php/includes_user.php");
include("../php/functions_admin.php");
if(isset($_SESSION['loggedin']) && $_SESSION['rol'] == 1){ 
    $lista = (isset($_GET['lista']) ? $_GET['lista'] : "pendientes");
    if(isset($_GET['buscar'])){
      $buscar = $_GET['buscar'];
      if($buscar == "completos"){

        echo "completos";
      } else if ($buscar == "cancelados") {
        echo "cancelados";
      }
    }
?>
<style>
.hover_sha_orange:hover{box-shadow: 0 0 5px orange}
.hover_sha_green:hover{box-shadow: 0 0 5px green}
.hover_sha_red:hover{box-shadow: 0 0 5px red}
#pedidos {
  padding:10px 0;
  & .pedidos__btn_opciones {
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
  & .pedidos__btn_opciones:hover {
    background: #e5e5e5;
  }
  & .listado_pedidos a {
        width: 100%;
        margin:2px 0;
        transition: ease 1s;
        padding:10px 0;
        display:flex;
        justify-content:space-around;
        align-items: center;
    }
    & .listado_pedidos a div {padding:0 10px;}
}
.a_pendientes {background-color: orange}
.a_completos {background-color: green}
.a_cancelados {background-color: red}
.a_pendientes:hover {background: orangered}
.a_completos:hover {background-color: #00e600}
.a_cancelados:hover {background-color: #990000}
</style>
<body>
    <div id="contenido">
        <div id="pedidos">
          <a class="pedidos__btn_opciones hover_sha_orange" href="?lista=pendientes">PENDIENTES</a>
          <a class="pedidos__btn_opciones hover_sha_green" href="?lista=completos">COMPLETOS</a>
          <a class="pedidos__btn_opciones hover_sha_red" href="?lista=cancelados">CANCELADOS</a>
          <div id="listado"><?=mostrarLista()?>
          </div>
        </div>
    </div>
</body>
</html>
<?php } else {header("location: ../index.php");}?>

<!-- JS PARA ACTULIZAR EL LISTADO DE PENDIENTES -->
<?php if($lista == "pendientes"){ ?> 
<script>
setInterval(function() {
    $("#listado").load("./PEDIDOS/listado.php?lista=pendientes");
},10000);
</script>
<?php } ?>


<?php
function mostrarLista(){
  include("./PEDIDOS/listado.php");
}

?>