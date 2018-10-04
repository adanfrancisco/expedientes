<?php 
	include 'db.php';
	$consulta="select * from localidades order by localidad_nombre";
	$rs_1 = $db->consulta($consulta);
	

	$localid = array();
	while ($fila = odbc_fetch_array($rs_1)) {
		$localid[$fila['idLocalidad']] = $fila['localidad_nombre'];
	}
	 print_r(json_encode($localid));
	

?>