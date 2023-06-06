<?php
include("../../sql/config.php");
include("../../sql/consultas.php");
function obtener(){
$resultado = $GLOBALS['conexion']->query("SELECT * FROM ventascliente WHERE estado = 0");
if($resultado->rowCount()){
    foreach($resultado->fetchAll(PDO::FETCH_ASSOC) as $dato){
        $tabla .= '<a href="#" class="a_pendientes"><div class="pendientes__lista">
                        <div>'.$dato['id_usuario'].'</div>
                        <div>'.formato_fecha($dato['fecha']).'</div>
                        <div>$1000.00</div>
                    </div></a>';
    }
    return $tabla;
}
}
echo obtener();
?>