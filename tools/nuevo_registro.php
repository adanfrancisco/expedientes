<?php

     include "db.php";

if($_POST)
    {   $dni=!empty($_POST['dni']) ? $_POST['dni'] : "00000000";
        $apellido=!empty($_POST['apellido']) ? strtoupper($_POST['apellido'])  : 'apellido';
        $nombre=!empty($_POST['nombre']) ? strtoupper($_POST['nombre'])  : 'nombre';
        $localidad=!empty($_POST['localidad']) ? $_POST['localidad']  : 1;
        $domicilio = !empty($_POST['domicilio']) ? strtoupper($_POST['domicilio']) : 'sin registro';
        $telefono_fijo=!empty($_POST['telfijo']) ? $_POST['telfijo']  : 0;
        $telefono_celular=!empty($_POST['telcel']) ? $_POST['telcel']  : 0;
        $email = !empty($_POST['email']) ? '$_POST["email"]' : 'sinmail';
        $fecha=!empty($_POST['fecha']) ? $_POST['fecha']  : '01/01/1900';


//busco a ver si ya esta...
$sql="SELECT count(cuil) as counter FROM PERSONA where cuil='$dni'";
//echo '<br>'.$sql;
$stmt=$db->consulta($sql);
$arr = odbc_fetch_array($stmt);
//echo '<BR>hay: '.$arr['counter'];
$count=$arr['counter'];

//    $count=$stmt->rowCount();

if($count>0){
    echo '<br>Ya Existe esa asociacion';
}else{
        $sql="INSERT INTO persona(cuil, apellido, nombre, localidad, domicilio, telefono, celular, email, fech_nac, activo )
        VALUES('$dni', '$apellido' , '$nombre', $localidad , '$domicilio' , '$telefono_fijo' ,
        '$telefono_celular' , '$email', '$fecha' , 2)";


  //      echo $sql;
        $rs = $db->consulta($sql);
        echo ' Exitoso!';
        }
}

    $db->desconectar(); 
?>