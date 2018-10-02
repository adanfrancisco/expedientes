<?php
$link = mysql_connect('localhost', 'usuariobbdd', 'password')
    or die('No se pudo conectar: ' . mysql_error());
mysql_select_db('nombrebasededatos') or die('No se pudo seleccionar la base de datos');

$query="SELECT id,nombre FROM paises ORDER BY nombre";
$result = mysql_query($query)
        or die("Ocurrio un error en la consulta SQL");
mysql_close();
echo '<option value="0">Seleccionar</option>';
while (($fila = mysql_fetch_array($result)) != NULL) {
    echo '<option value="'.$fila["id"].'">'.$fila["nombre"].'</option>';
}
// Liberar resultados
mysql_free_result($result);

// Cerrar la conexión
mysql_close($link);

?>
