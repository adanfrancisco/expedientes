<?php

     include "db.php";

if($_POST)
    {
        $cuil=isset($_POST['cuil']) ? $_POST['cuil'] : null;
        $apellido=isset($_POST['apellido']) ? $_POST['apellido']  : null;
        $nombre=isset($_POST['nombre']) ? $_POST['nombre']  : null;
        $localidad=isset($_POST['localidad']) ? $_POST['localidad']  : null;
        $domicilio = isset($_POST['domicilio']) ? $_POST['domicilio'] : null;
        $telefono_fijo=isset($_POST['telfijo']) ? $_POST['telfijo']  : null;
        $telefono_celular=isset($_POST['telcel']) ? $_POST['telcel']  : null;
        $email=isset($_POST['email']) ? $_POST['email']  : null;
        $fecha=isset($_POST['fecha']) ? $_POST['fecha']  : null;


//$name = strip_tags($_POST['name1']);


$sql="INSERT INTO persona(cuil, apellido, nombre, localidad, domicilio, telefono, celular, email, fech_nac, activo )
VALUES('$cuil', '$apellido' , '$nombre', $localidad , '$domicilio' , '$telefono_fijo' ,
 '$telefono_celular' , '$email', '$fecha' , 2)";
$rs = $db->consulta($sql);
echo $sql;
 }

    $db->desconectar(); 
?>