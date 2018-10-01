<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>MESA-Alta de Personas</title>
        <script type="text/javascript" src="http://code.jquery.com/jquery-2.1.1.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>
        <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css" rel="stylesheet">
		<script type="text/javascript" src="js/edit.js"></script>
		<script type="text/javascript" src="js/jquery.mask.min.js"></script>
		<script src="js/examples.js"></script>

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

<script type="text/javascript" src="js/jquery.mask.min.js"></script>
<script src="js/examples.js"></script>

<?php

    include "../mesa/adodb5/adodb.inc.php";
    include "../mesa/access_conn.php";

#se crea instancia a clase
    $db = new database();
    $db->conectar();

if($_POST)
    {
$name = strip_tags($_POST['name']);


$sql="SELECT COUNT(apellido) as counter FROM persona WHERE apellido='".$name."' and activo=2";
// echo '<BR>'.$sql;
    $stmt=$db->consulta($sql);
    $arr = odbc_fetch_array($stmt);
 //    echo '<BR>hay: '.$arr['counter'];
    $count=$arr['counter'];

//    $count=$stmt->rowCount();

   if($count>0)
   {
/*      echo    '<BR>
             Ya existe';  */
$sql="SELECT * FROM persona WHERE apellido like '".$name."' and activo=2";
    $rs = $db->consulta($sql);
    echo '<br/>';
echo '    <table border="1">
<th>Nº</th><th>C.U.I.T.</th><th>APELLIDO</th> <th>NOMBRE</th><th>LOCALIDAD</th><th>DOMICILIO</th><th>TELEFONO</th><th>CELULAR</th><th>EMAIL</th>';
    while ( odbc_fetch_row($rs) )
echo '

    <tr>
    <td><input name="dni" type="radio" value='.odbc_result($rs,"cuil").'></td>
    <td name="cuit" id="cuit" value='.odbc_result($rs,"cuil").'>'.odbc_result($rs,"cuil").'</td>
    <td> '.odbc_result($rs,"apellido").'   </td>
    <td> '.odbc_result($rs,"nombre").'</td>
    <td> '.odbc_result($rs,"localidad").' </td>
    <td> '.odbc_result($rs,"domicilio").' </td>
    <td class="phone_with_ddd"> '.odbc_result($rs,"telefono").' </td>
    <td class="phone_with_ddd"> '.odbc_result($rs,"celular").' </td>
    <td> '.odbc_result($rs,"email").' </td>
    </tr>';

echo '</table>';
echo '
<input type="hidden" id="xdni" name="xdni" value="'.odbc_result($rs,"cuil").'">'
.'<input type="hidden" id="xapellido" name="xapellido" value="'.odbc_result($rs,"apellido").'">'
.'<input type="hidden" id="xnombre" name="xnombre" value="'.odbc_result($rs,"nombre").'">'
.'<input type="hidden" id="xlocalidad" name="xlocalidad" value="'.odbc_result($rs,"localidad").'">'
.'<input type="hidden" id="xdomicilio" name="xdomicilio" value="'.odbc_result($rs,"domicilio").'">'
.'<input type="hidden" id="xtelefono" name="xtelefono" value="'.odbc_result($rs,"telefono").'">'
.'<input type="hidden" id="xcelular" name="xcelular" value="'.odbc_result($rs,"celular").'">'
.'<input type="hidden" id="xemail" name="xemail" value="'.odbc_result($rs,"email").'">'
;
?>
<script>mostrar();</script>
<?php

   }
   else
   {
    ?>

    <script>
        console.log('Hay q dar el alta porque no existe');
        mostrar_alta();

    </script>

    <?php
   }
 }

    $db->desconectar();
?>