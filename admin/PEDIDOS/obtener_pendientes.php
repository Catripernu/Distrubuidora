<?php
include("../../sql/config.php");
include("../../sql/consultas.php");
include("../../php/functions_admin.php");
include("../../php/functions_users.php");
function obtener(){
$resultado = $GLOBALS['conexion']->query("SELECT * FROM ventascliente WHERE estado = 0 ORDER BY fecha desc");
if($resultado->rowCount()){
    foreach($resultado->fetchAll(PDO::FETCH_ASSOC) as $dato){
        $tabla .= '<a href="#" class="a_pendientes">
                        <div>'.cliente($dato['id_usuario'],$dato['ID']).'</div>
                        <div>'.formato_precio($dato['total']).'</div>
                        <div>'.formato_fecha($dato['fecha']).'</div>
                    </a>';
    }
    return $tabla;
}
}
echo obtener();
?>