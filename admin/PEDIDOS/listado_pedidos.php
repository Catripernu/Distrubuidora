<?php
include("../../sql/config.php");
include("../../sql/consultas.php");
// Obtén el ID del botón enviado desde JavaScript
$botonID = $_GET['boton'];
$lista = $_GET['lista'];
if($lista == 1){
    $pagina_completos = $_GET['pagina'];
}
if($lista == 2){
    $pagina_cancelados = $_GET['pagina'];
}

echo "<p>";
if($botonID == "pendientes"){
    echo "contenido $botonID";
} else {
    if($botonID == "completos"){
        echo "contenido $botonID";
        paginacion(false, $pagina_completos, 3,1);
    } else {
        echo "contenido $botonID";
        paginacion(false, $pagina_cancelados, 10,2);
    }
}
echo "</p>";
?>
