<?php 
$nivel=$_POST['cod_nivel'];
//$nivel=2;
	include 'db.php';
	$consulta="select * from niveles inner join ESCUELA on niveles.id_nivel=ESCUELA.NIVEL where ESCUELA.nivel=$nivel";
	$rs_1 = $db->consulta($consulta);
	
	echo '<select name="escuelas"><option>SELECCIONE</option>';

	$nivel = array();
	while ($fila = odbc_fetch_array($rs_1)) {
//		$nivel[$fila['CLAVE']] = $fila['NOMBRE'];
		echo '<option name="' . $fila['CLAVE'] . '">'.$fila['NOMBRE'].' - '.$fila['CLAVE'].'</option>';
//		echo '<option name="' + $fila['CLAVE'] + '">' + $fila['CLAVE']+ '</option>';
	}
	 
	 echo '</select>';
	
	 //print_r(json_encode($nivel));
?>