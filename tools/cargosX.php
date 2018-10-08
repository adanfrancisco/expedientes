<?php 
	include 'db.php';
	$consulta="select * from cargos";
	$rs_1 = $db->consulta($consulta);


	$cargos = array();
	while ($fila = odbc_fetch_array($rs_1)) {
		$cargos[$fila['id_cargo']] = $fila['cargo'];
		
	}
	 print_r(json_encode($cargos));
	

?>