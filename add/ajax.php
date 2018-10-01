<?php
	include 'db.php';

	if (isset($_GET['edit'])) {

		$column = $_GET['column'];
		$id = $_GET['id'];
		$newValue = $_GET["newValue"];

		$sql = "UPDATE persona SET $column = '$newValue' WHERE cuil ='$id'";
		//echo $sql;

		if($db->consulta($sql)){
		$response['success'] = true;
		$response['value'] = $newValue;
	}
		echo json_encode($response);

	}
?>