<?php
include("../../sql/config.php");
include("../../sql/consultas.php");
include("../../php/functions_admin.php");
include("../../php/functions_users.php");
$resultados_por_pagina_listado_pendientes = 1;

// Obtén el ID del botón enviado desde JavaScript
$botonID = $_GET['boton'];
$lista = $_GET['lista'];
if($lista == 1){
    $pagina_completos = $_GET['pagina'];
    $pagina_cancelados = 1;
}
if($lista == 2){
    $pagina_cancelados = $_GET['pagina'];
    $pagina_completos = 1;
}
if($lista == 0){
    $pagina_cancelados = 1;
    $pagina_completos = 1;
}
if($botonID == "pendientes"){
    $resultado = $GLOBALS['conexion']->query("SELECT * FROM ventascliente WHERE estado = 0 ORDER BY fecha desc");
    if($resultado->rowCount()){
        echo "<div class='listado_pedidos'>";
        foreach($resultado as $dato){
            echo '<a href="#" class="a_pendientes">
                    <div>'.cliente($dato['id_usuario'],$dato['ID']).'</div>
                    <div>'.formato_precio($dato['total']).'</div>
                    <div>'.formato_fecha($dato['fecha']).'</div>
                  </a>';
        }
        echo "</div>";
    }
} else {
    if($botonID == "completos"){
        $res = resultados_paginacion($resultados_por_pagina_listado_pendientes, $pagina_completos, "ventascliente", "estado = 1");
        $num_paginas = ceil($res['total_elementos']->rowCount() / $resultados_por_pagina_listado_pendientes);
        // LISTADO DE VENTAS COMPLETAS REALIZADAS
        echo "<div class='listado_pedidos'>";
        foreach($res['elementos'] as $row){
            echo "ID: ".$row['ID']." - Total: ".$row['total']."<br>";
        }
        echo "</div>";
        // PAGINACION
        paginacion(false, $pagina_completos, $num_paginas,1);
    } else {
        $res = resultados_paginacion($resultados_por_pagina_listado_pendientes, $pagina_cancelados, "ventascliente", "estado = 2");
        $num_paginas = ceil($res['total_elementos']->rowCount() / $resultados_por_pagina_listado_pendientes);
        // LISTADO DE VENTAS CANCELADAS REALIZADAS
        echo "<div class='listado_pedidos'>";
        foreach($res['elementos'] as $row){
            echo "ID: ".$row['ID']." - Total: ".$row['total']."<br>";
        }
        echo "</div>";
        // PAGINACION
        paginacion(false, $pagina_cancelados, $num_paginas,2);
    }
}
?>
