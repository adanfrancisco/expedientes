<style>

table {
   width: 100%;
   border: .2px solid #000;
}
th, td {
   width: 10%;
   text-align: left;
   vertical-align: top;
   border: .5px solid #0a0;
}

</style>
<?php

include "../mesa/adodb5/adodb.inc.php";
include "../mesa/access_conn.php";

$db = new database();
$db->conectar();


$sql="SELECT niveles.Nivel, ESCUELA.NOMBRE as nombre, ESCUELA.DOMICILIO, localidades.localidad_nombre as localidad,
escuela.telefono
FROM niveles INNER JOIN (ESCUELA INNER JOIN localidades ON ESCUELA.LOCALIDAD = localidades.idLocalidad) 
ON niveles.Id_nivel = ESCUELA.NIVEL order by niveles.Id_nivel,nombre";

$rs = $db->consulta($sql);
echo '<H1>LISTADO DE ESCUELAS</H1>';

?>
<table  CELLPADDING=0 CELLSPACING=1> 
<th>NIVEL</th><th>NOMBRE</th> <th>DIRECCION</th><th>TELEFONO</th><th>LOCALIDAD</th>

<?php

while(odbc_fetch_row($rs))
echo '<tr>
<td> '.odbc_result($rs,"nivel").'   </td>
<td> '.odbc_result($rs,"nombre").'   </td>
<td> '.odbc_result($rs,"domicilio").'</td>
<td> '.odbc_result($rs,"telefono").'</td>
<td> '.odbc_result($rs,"localidad").' </td>
</tr>';

?>
</table>
