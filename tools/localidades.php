<?php 
//var $array = [];
	include 'db.php';
	$consulta="select * from localidades order by localidad_nombre";
	$rs_1 = $db->consulta($consulta);
	


	while($var = odbc_fetch_array($rs_1)){
		$array[] = $var;
	
	}
	
	echo json_encode($array);
?>