<?php
include("../../sql/config.php");
include("../../sql/consultas.php");
// Obtén el ID del botón enviado desde JavaScript
$botonID = $_GET['boton'];

echo "<p>";
if($botonID == "pendientes"){
    echo "contenido $botonID";
} else {
    if($botonID == "completos"){
        echo "contenido $botonID";
    } else {
        echo "contenido $botonID";
        // paginacion(1, 1, 12,2);
    }
}
echo "</p>";
?>
