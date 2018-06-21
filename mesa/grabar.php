<?php
    include "adodb5/adodb.inc.php";
    include "access_conn.php";

$carrera=$_POST['servicio'];
$mensaje=$_POST['mensaje'];

echo 'HA CARGADO: ' .$mensaje .' <br> EN LA ESCUELA:-->'.$carrera;


    #se crea instancia a clase
    $db = new database();
    $db->conectar();

    #Se realiza consulta
   $rs = $db->consulta( "INSERT INTO MESA(mensaje,escuela) VALUES('$mensaje','$carrera')" );

    $db->desconectar();
    ?>