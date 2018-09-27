<?php
    include "adodb5/adodb.inc.php";
    include "access_conn.php";

$quien=$_POST['quien'];
$carrera=$_POST['servicio'];
$mensaje=$_POST['mensaje'];
$atendio=$_POST['atendio'];
$derivado=$_POST['derivado'];

echo 'HA CARGADO: ' .$mensaje .' <br> EN LA ESCUELA:-->'.$carrera;
echo '<br><b>'.date('d-m-Y').'</b>';



    #se crea instancia a clase
    $db = new database();
    $db->conectar();

    #Se realiza consulta
   $rs = $db->consulta( "INSERT INTO MESA(mensaje,escuela,atiende,derivado) VALUES('$mensaje','$carrera','$atendio','$derivado')" );
   //verifico si tiene OTRO origen
if(strlen($quien)>1){
//busco el ultimo registro
$sql="SELECT max(id) as ultimo FROM mesa where escuela='9999OO9999'";
$rs = $db->consulta($sql);
while ( odbc_fetch_row($rs) )
{$ultimo= odbc_result($rs,"ultimo");}


    $rs = $db->consulta( "INSERT INTO OTRO(id_mesa,clave,otro) VALUES('$ultimo','$carrera','$quien')" );
}
    $db->desconectar();
    ?>