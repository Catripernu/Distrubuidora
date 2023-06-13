<?php 
include("../../sql/config.php");
include("../../sql/consultas.php");
include("../../php/functions_admin.php");

$lista = isset($_GET['lista']) ? $_GET['lista'] : "pendientes";
$pagina = isset($_GET['pagina']) ? $_GET['pagina'] : 1;
$pedidos_resultado_por_pagina = 10;

obtenerListado($lista,$pagina,$pedidos_resultado_por_pagina);


function obtenerListado($lista,$pagina,$r_paginas){
    $msj_error = "<p class='rojo'><b>ERROR</b>: NO HAY REGISTROS TODAVIA</p>";
    if($lista == "pendientes"){
        $resultado = $GLOBALS['conexion']->query("SELECT * FROM ventascliente WHERE estado = 0 ORDER BY fecha desc");
        if($resultado->rowCount()){
            divListadoPedidos($resultado,$lista);
        } else {
            echo $msj_error;
        }
    } else {
        $get = (isset($_SERVER['QUERY_STRING'])) ? $_SERVER['QUERY_STRING'] : "";
        $estado = ($lista == "completos") ? "estado = 1  ORDER BY fecha DESC" : "estado = 2 ORDER BY fecha DESC";
        $res = resultados_paginacion($r_paginas, $pagina, "ventascliente", $estado);
        $num_paginas = ceil($res['total_elementos']->rowCount() / $r_paginas);
        // LISTADO DE VENTAS COMPLETAS REALIZADAS
        if($res['elementos']->rowCount()){
            divListadoPedidos($res['elementos'],$lista);
        } else {
            echo $msj_error;
        }
        // PAGINACION
        paginacion_v2($pagina,$num_paginas,$get);
    }
}
function divListadoPedidos($res,$lista){
    echo "<div class='listado_pedidos'>";
    foreach($res as $dato){
        echo '<a href="#" class="a_'.$lista.'">
                <div>'.cliente($dato['id_usuario'],$dato['ID']).'</div>
                <div>'.formato_precio($dato['total']).'</div>
                <div>'.formato_fecha($dato['fecha']).'</div>
              </a>';
    }
    echo "</div>";
}
?>
