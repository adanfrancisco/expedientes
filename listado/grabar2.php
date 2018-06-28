<?php
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
   
    ?>

    <table border="1" ALIGN="CENTER">
        <th>Fecha</th> <th>CLAVE</th><th>ESCUELA</th><th>MENSAJE</th>
    <?php
    while ( odbc_fetch_row($rs) )

    echo '<tr><td> '.(date('d-m-Y', strtotime(odbc_result($rs,"fecha")))).' </td>
    <td> ----'.odbc_result($rs,"escuela").' ----  </td>
    <td> ----'.odbc_result($rs,"nombre").' ----</td>
    <td> '.odbc_result($rs,"mensaje").' </td>
    </tr>';


    ?>

    </table>
    <br><br><br><br>
    <?php


    $db->desconectar();
    ?>