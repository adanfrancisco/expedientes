<?php

     include "../mesa/adodb5/adodb.inc.php";
    include "../mesa/access_conn.php";

#se crea instancia a clase
    $db = new database();
    $db->conectar();

if($_POST)
    {
        $cuil=$_POST['cuil'];
        $apellido=$_POST['apellido'];     
        $nombre=$_POST['nombre'];     
//$name = strip_tags($_POST['name1']);


$sql="INSERT INTO persona(cuil, apellido, nombre, localidad, domicilio, telefono, celular, email, fech_nac, activo )
VALUES('$cuil', '$apellido' , '$nombre', 1 , 'NUEVO' , '0' , '0' , '-', '01/01/1900' , 2)";
$rs = $db->consulta($sql);
echo $sql;
 }

    $db->desconectar(); 
?>