
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<style type="text/css">
/* Formatear el formulario a dos columnas */
body {
  font: 13px/1.6 Tahoma, sans-serif;
  background: #F5F5F5;
}
table{
    background:#ffffff;
    }
</style>
<?php

    include "../mesa/adodb5/adodb.inc.php";
    include "../mesa/access_conn.php";

#se crea instancia a clase
    $db = new database();
    $db->conectar();

if($_POST)
    {
$name = strip_tags($_POST['name']);


$sql="SELECT COUNT(apellido) as counter FROM persona WHERE apellido='".$name."'";
// echo '<BR>'.$sql;
    $stmt=$db->consulta($sql);
    $arr = odbc_fetch_array($stmt);
//     echo '<BR>hay: '.$arr['counter'];
    $count=$arr['counter'];

//    $count=$stmt->rowCount();

   if($count>0)
   {
 /*    echo    '<BR>
             Ya existe'; */
$sql="SELECT * FROM persona WHERE apellido='".$name."'";
    $rs = $db->consulta($sql);
    echo '<br/>';
echo '    <table border="1">
        <th>APELLIDO</th> <th>NOMBRE</th><th>LOCALIDAD</th><th>DOMICILIO</th><th>TELEFONO</th><th>CELULAR</th><th>EMAIL</th>';
    while ( odbc_fetch_row($rs) )

    echo '<tr>
    <td> '.odbc_result($rs,"apellido").'   </td>
    <td> '.odbc_result($rs,"nombre").'</td>
    <td> '.odbc_result($rs,"localidad").' </td>
    <td> '.odbc_result($rs,"domicilio").' </td>
    <td> '.odbc_result($rs,"telefono").' </td>
    <td> '.odbc_result($rs,"celular").' </td>
    <td> '.odbc_result($rs,"email").' </td>
    </tr>';

echo '</table>';
?>
<script>mostrar();</script>
<?php

   }
   else
   {
    ?>

    <script>
        console.log('Hay q dar el alta');
        mostrar_alta();
    </script>

    <?php
   }
 }

    $db->desconectar();
?>