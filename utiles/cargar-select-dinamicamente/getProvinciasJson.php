<?php
$link = mysql_connect('localhost', 'usuariobbdd', 'password')
    or die('No se pudo conectar: ' . mysql_error());
mysql_select_db('nombrebasededatos') or die('No se pudo seleccionar la base de datos');

$query="SELECT id,nombre FROM provincias WHERE id_pais=".$_REQUEST["pais"]." ORDER BY nombre";
$result = mysql_query($query)
        or die("Ocurrio un error en la consulta SQL");
mysql_close();

$provincias = array();
while (($fila = mysql_fetch_array($result)) != NULL) {
    $provincias[$fila['id']] = $fila['nombre'];
}
print_r(json_encode($provincias));

// Liberar resultados
mysql_free_result($result);

// Cerrar la conexión
mysql_close($link);

?>
