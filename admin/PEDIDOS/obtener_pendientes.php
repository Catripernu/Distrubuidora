<?php
include("../../sql/config.php");
function obtener(){
$resultado = $GLOBALS['conexion']->query("SELECT * FROM ventascliente WHERE estado = 0");
if($resultado->rowCount()){
    foreach($resultado->fetchAll(PDO::FETCH_ASSOC) as $dato){
        $tabla .= '<div class="pendientes__lista back_orange">
                        <div>'.$dato['id_usuario'].'</div>
                        <div class="telefono">'.$dato['telefono'].'</div>
                        <div>'.$dato['fecha'].'</div>
                        <div>$1000.00</div>
                    </div><br>';
    }
    return $tabla;
}
}
echo obtener();
?>