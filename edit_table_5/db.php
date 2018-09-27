<?php

/* 	define('DB','your_database_name');
	define('USER','your_user_name');
	define('PWD','your_password');

	$dbh = new PDO('mysql:host=localhost;dbname='.DB,USER,PWD);
 */


include "../mesa/adodb5/adodb.inc.php";
include "../mesa/access_conn.php";

#se crea instancia a clase
$db = new database();
$db->conectar();
?>