<?php

    include "../mesa/adodb5/adodb.inc.php";
    include "../mesa/access_conn.php";

#se crea instancia a clase
    $db = new database();
    $db->conectar();

if($_POST)
    {
$name = strip_tags($_POST['name']);


$sql="SELECT COUNT(cuil) as counter FROM persona WHERE cuil='".$name."' and activo=2";
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
$sql="SELECT * FROM persona INNER JOIN localidades  ON localidades.idLocalidad = persona.localidad WHERE cuil like '".$name."' and activo=2";
    $rs = $db->consulta($sql);
    echo '<br/>';
echo '<table border=1 style="border-collapse:collapse";>
<th>C.U.I.T.</th><th>APELLIDO</th> <th>NOMBRE</th><th>LOCALIDAD</th>
<th>DOMICILIO</th><th>TELEFONO</th><th>CELULAR</th><th>EMAIL</th><th>FECHA</th>';
    while ( odbc_fetch_row($rs) )
echo '

    <tr>

    <td name="cuit" id="cuit" value='.odbc_result($rs,"cuil").'>'.odbc_result($rs,"cuil").'</td>
    <td> '.odbc_result($rs,"apellido").'   </td>
    <td> '.odbc_result($rs,"nombre").'</td>';
    echo '<td class="'.odbc_result($rs,"localidad").'" name="'.odbc_field_name($rs,"4").'" data-id="'.odbc_result($rs,"localidad").'">'.odbc_result($rs,"localidad_nombre").'</td>';
    echo '<td> '.odbc_result($rs,"domicilio").' </td>';
    echo '<td class="phone_with_ddd"> '.odbc_result($rs,"telefono").' </td>
    <td class="phone_with_ddd"> '.odbc_result($rs,"celular").' </td>
    <td> '.odbc_result($rs,"email").' </td>';
    $fecha = '';
    if(odbc_result($rs,"fech_nac") != '')
    $fecha=odbc_result($rs,"fech_nac");
        $fecha = date_format(date_create(odbc_result($rs,"fech_nac")), 'd-m-Y');

    echo '<td class="'.$fecha.' datex" name="'.odbc_field_name($rs,"9").'">'. $fecha .'</td>';

    echo '</tr>';

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
<button type="button" id="btn_usar" class="btn btn-primary usar">USAR</button>
<!-- <script>mostrar();</script> -->

<?php

   }
   else
   {
    ?>

    <script>
        //console.log('Hay q dar el alta porque no existe');
      /*   mostrar_alta(); */

    </script>

    <?php
   }
 }

    $db->desconectar();
?>