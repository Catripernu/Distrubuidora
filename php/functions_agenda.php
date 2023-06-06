<?php 
function add_cliente($id){
    $nombre = strtoupper($_POST['nombre']);
    $apellido = strtoupper($_POST['apellido']);
    $direccion = strtoupper($_POST['domicilio']);
    $fecha = date("Y-m-d");
    $telefono = $_POST['telefono']; 
    $verificamos = $GLOBALS['conexion']->query("SELECT * FROM agenda WHERE telefono_agenda = $telefono")->rowCount();
    if(!$verificamos) {
        $GLOBALS['conexion']->query("INSERT INTO agenda (id_vendedor,nombre_agenda,apellido_agenda,direccion_agenda,telefono_agenda,fecha_agenda) 
                        VALUES ('$id','$nombre','$apellido','$direccion','$telefono','$fecha')");
        $msj = "<p class='verde'>CLIENTE REGISTRADO CON EXITO</p>";
    } else {
        $msj = "<p class='rojo'>YA EXISTE CLIENTE REGISTRADO</p>";
    }
    return $msj;
}
function edit(){
    $id_agenda = $_POST['id_agenda'];
    $nombre = strtoupper($_POST['nombre']);
    $apellido = strtoupper($_POST['apellido']);
    $direccion = strtoupper($_POST['direccion']);
    $telefono = $_POST['telefono'];

    if ($GLOBALS['conexion']->query("UPDATE agenda SET nombre_agenda= '$nombre', apellido_agenda = '$apellido', direccion_agenda = '$direccion', telefono_agenda = '$telefono' WHERE id_agenda = $id_agenda")) {
        $msj = "<p class='verde'>Registro actualizado con exito</p>";
    } else {
        $msj = "<p class='rojo'>Error: ".$GLOBALS['conexion']->errorInfo()."</p>";
    }
    return $msj;
}
?>