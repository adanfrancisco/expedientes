<?php
//establecemos el timezone para obtener la hora local
date_default_timezone_set('America/Buenos_Aires');

//la fecha de exportación sera parte del nombre del archivo Excel
//$fecha = date("d-m-Y");
$nivel=$_POST['nivel'];
$contenido=$_POST['contenido'];
//$nivel='adan';
//Inicio de exportación en Excel
header('Content-type: application/vnd.ms-excel');
header("Content-Disposition: attachment; filename=Reporte_$nivel._.$fecha.xls"); //Indica el nombre del archivo resultante
header("Pragma: no-cache");
header("Expires: 0");


    include "adodb5/adodb.inc.php";
    include "access_conn.php";

$fecha=(string)$_POST['fecha'];
$fecha2=$_POST['fecha2'];

    $db = new database();
    $db->conectar();


$fechaFFase="$fecha";
$posterior = new DateTime($fechaFFase);
$posterior= $posterior->format('m/d/Y');

$fechaFFase2="$fecha2";
$anterior = new DateTime($fechaFFase2);
$anterior=$anterior->format('m/d/Y');

 
 $sql="SELECT * FROM niveles 
 INNER JOIN (ESCUELA INNER JOIN mesa ON ESCUELA.CLAVE = mesa.escuela) ON niveles.Id_nivel = ESCUELA.NIVEL 
 WHERE (((mesa.fecha)>#".$posterior."# And (mesa.fecha)<#".$anterior."#))";




    $rs = $db->consulta($sql);
    echo '<br/>';
    ?>

    <table border="1" ALIGN="CENTER">
        <th>Fecha - Hora</th> <th>CLAVE-ESC</th><th>ESCUELA</th><th>-------------MENSAJE-----------</th>
    <?php
    while ( odbc_fetch_row($rs) )

    echo '<tr><td> '.(date('d-m-Y', strtotime(odbc_result($rs,"fecha")))).' </td>
    <td> ----'.odbc_result($rs,"escuela").' ----  </td>
    <td> ----'.odbc_result($rs,"nombre").' ----</td>
    <td> '.odbc_result($rs,"mensaje").' </td>
    </tr>';


    ?>

    </table>
    <?php


    $db->desconectar();
    ?>

?>