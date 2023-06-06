<?php 
session_start();
include_once("./../../sql/config.php");
$id = $_GET['id'];
$id_vendedor = $_SESSION['id'];
$consulta = $conexion->query("SELECT * FROM agenda WHERE id_agenda = $id AND id_vendedor = $id_vendedor")->rowCount();
if($consulta){
    $conexion->query("DELETE FROM agenda WHERE id_agenda = $id and id_vendedor = $id_vendedor");
    echo "success";
} else {
    echo "NO ES TU CLIENTE";
}
?>