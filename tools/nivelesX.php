<?php 
	include 'db.php';
	$consulta="select * from niveles";
	$rs_1 = $db->consulta($consulta);
	

	$nivel = array();
	while ($fila = odbc_fetch_array($rs_1)) {
		$nivel[$fila['id_nivel']] = $fila['nivel'];
	}
	 print_r(json_encode($nivel));
	

?>