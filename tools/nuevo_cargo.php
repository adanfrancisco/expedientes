<?php

     include "db.php";

if($_POST)
    {   $cod_escuelas=isset($_POST['cod_escuelas']) ? $_POST['cod_escuelas'] : null;
        $cod_cargos=isset($_POST['cod_cargos']) ? strtoupper($_POST['cod_cargos'])  : null;
        $cod_nivel=isset($_POST['cod_nivel']) ? strtoupper($_POST['cod_nivel'])  : null;
        $dni=isset($_POST['dni']) ? $_POST['dni']  : null;

//busco a ver si ya esta...
echo  'dni: ' .$dni .' CARGO: '. $cod_cargos .' ESCUELA:'. $cod_escuelas .'  NIVEL: '. $cod_nivel.' <BR><b>Registro Guardado!</b>';
$sql="SELECT count(persona) as counter FROM SERVICIOS where persona='$dni' and escuela = '$cod_escuelas' and cargo =  $cod_cargos";
//echo '<br>'.$sql;
$stmt=$db->consulta($sql);
$arr = odbc_fetch_array($stmt);
//echo '<BR>hay: '.$arr['counter'];
$count=$arr['counter'];

//    $count=$stmt->rowCount();

if($count>0){
    echo '<br><b>Ya Existe esa asociacion</b>';
}else{
    //echo '<br>Hay que darlo de alta';
    $sql="INSERT INTO SERVICIOS(escuela, cargo, persona, fecha_alta, fecha_baja, activo)
VALUES('$cod_escuelas', $cod_cargos , '$dni', null, null , 1)";
//echo '<br>'.$sql;
$stmt=$db->consulta($sql);
}
    }



