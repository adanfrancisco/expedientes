<?php
    include "adodb5/adodb.inc.php";
    include "access_conn.php";

$exporta=$_POST['exporta'];
$fecha=(string)$_POST['fecha'];
$nivel=$_POST['nivel'];
//echo $nivel;
//$fecha='21-6-2018';
    #se crea instancia a clase
    $db = new database();
    $db->conectar();
  // echo '<br>'.$fecha;

$fechaFFase="$fecha";
/* $posterior = new DateTime($fechaFFase);
$posterior->modify('+1 day');
$posterior= $posterior->format('m/d/Y'); */

$anterior = new DateTime($fechaFFase);
// $anterior->modify('-1 day');
$anterior=$anterior->format('m/d/Y');


$sql="SELECT * FROM niveles INNER JOIN (ESCUELA INNER JOIN mesa ON ESCUELA.CLAVE = mesa.escuela) ON niveles.Id_nivel = ESCUELA.NIVEL
  where mesa.fecha >=#".$anterior."#  and niveles.Nivel='".$nivel."' order by mesa.fecha";

//echo $sql;
//$sql="SELECT * FROM mesa where mesa.fecha > #20/06/2018# and mesa.fecha < #22/06/2018#";

//echo '<br>'.$sql;
if($exporta==1){
echo $exporta;


}else{
    $rs = $db->consulta($sql);
    echo '<br/>';
    ?>

    <table border ="1" ALIGN="CENTER">

        <th>Fecha____Hora</th> <th>CLAVE</th><th>ESCUELA</th><th>MENSAJE</th><th>RECIBIO</th><th>DERIVADO</th>
    <?php
    while ( odbc_fetch_row($rs) )

    echo '<tr><td> '.odbc_result($rs,"fecha").' </td>
    <td> '.odbc_result($rs,"escuela").'   </td>
    <td> '.odbc_result($rs,"nombre").'</td>
    <td> '.odbc_result($rs,"mensaje").' </td>
    <td> '.odbc_result($rs,"atiende").' </td>
    <td> '.odbc_result($rs,"derivado").' </td>
    </tr>';
    ?>
</table>
<?php
  $db->desconectar();
}



?>