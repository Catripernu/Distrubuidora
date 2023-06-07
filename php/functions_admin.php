<?php 
// PEDIDOS.php
function pedidos($estado,$pagina){  
    $res = resultados_paginacion(1, $pagina, "ventascliente", "estado = '$estado' ORDER BY fecha desc");
	$num_paginas = ceil($res['total_elementos']->rowCount() / 1); 
    
    foreach($res['elementos'] as $row){
        echo "Nombre: ".$row['id_usuario']." Total: ".$row['total']."<br>";
    }
    paginacion(false,$pagina,$num_paginas,($estado+1));
}
function cliente($id,$id_venta){
    if($id){
        $dato_vendedor = user($id)->fetch(PDO::FETCH_ASSOC);
        if(comprador($id_venta)->rowCount()){            
            $datos = comprador($id_venta)->fetch(PDO::FETCH_ASSOC);
            return $datos['nombre']." ".$datos['apellido']." (".$dato_vendedor['nombre'].")";
        } else {
            return $dato_vendedor['nombre']." ".$dato_vendedor['apellido']." (CLIENTE)";
        }
    } else {
        $datos = comprador($id_venta)->fetch(PDO::FETCH_ASSOC);
        return $datos['nombre']." ".$datos['apellido']." (VISITA)";
    }
}
?>