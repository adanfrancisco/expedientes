<?php
    include "adodb5/adodb.inc.php";
    include "access_conn.php";

$carrera=$_POST['servicio'];
$mensaje=$_POST['mensaje'];
$atendio=$_POST['atendio'];
$derivado=$_POST['derivado'];

echo 'HA CARGADO: ' .$mensaje .' <br> EN LA ESCUELA:-->'.$carrera;
echo '<br><b>'.date('Y-m-d').'</b>';



    #se crea instancia a clase
    $db = new database();
    $db->conectar();

    #Se realiza consulta
   $rs = $db->consulta( "INSERT INTO MESA(mensaje,escuela,atiende,derivado) VALUES('$mensaje','$carrera','$atendio','$derivado')" );

    $db->desconectar();
    ?>