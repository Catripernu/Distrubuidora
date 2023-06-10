<?php 
include("../../sql/config.php");
include("../../sql/consultas.php");
include("../../php/functions_admin.php");

$lista = isset($_GET['lista']) ? $_GET['lista'] : "pendientes";
$pagina = $_GET['pagina'];

obtenerListado($lista,$pagina);


function obtenerListado($lista,$pagina){
    if($lista == "pendientes"){
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
        $res = resultados_paginacion(10, $pagina, "ventascliente", "estado = 1");
        var_dump($res['elementos']);
        $num_paginas = ceil($res['total_elementos']->rowCount() / 10);
        // LISTADO DE VENTAS COMPLETAS REALIZADAS
        echo "<div>";
        foreach($res['elementos'] as $row){
            echo "ID: ".$row['ID']." - Total: ".$row['total']."<br>";
        }
        echo "</div>";
        // PAGINACION
        paginacion(false, $pagina, $num_paginas,"completos");
    }
}

?>
