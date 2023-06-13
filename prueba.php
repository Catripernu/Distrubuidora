<?php
if (isset($_SERVER['QUERY_STRING'])) {
    $queryString = $_SERVER['QUERY_STRING'];
    parse_str($queryString, $params);

    // Reemplazar el valor de un parámetro específico
    $params['nuevo'] = 'nuevo_valor';

    // Reconstruir la línea GET actualizada
    $queryStringActualizada = http_build_query($params);

    // Generar la URL actualizada con la línea GET modificada
    $urlActualizada = $_SERVER['PHP_SELF'] . '?' . $queryStringActualizada;

    echo "URL actualizada: " . $urlActualizada;
} else {
    echo "No se encontró ninguna línea GET en la URL.";
}
?>
