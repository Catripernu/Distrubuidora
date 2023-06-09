<?php 
$lista = $_GET['lista'];

if($lista == "pendientes"){
    obtenerListado("pendientes");
}
if($lista == "completos"){
    obtenerListado("completos");
}
if($lista == "cancelados"){
    obtenerListado("cancelados");
}


function obtenerListado($lista){
    echo "TU LISTA $lista";
}

?>
