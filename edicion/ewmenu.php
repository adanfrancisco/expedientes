<?php

// Menu
$RootMenu = new cMenu("RootMenu", TRUE);
$RootMenu->AddMenuItem(1, "mi_SERVICIOS", $Language->MenuPhrase("1", "MenuText"), "SERVICIOSlist.php", -1, "", TRUE, FALSE, FALSE, "");
$RootMenu->AddMenuItem(2, "mi_cargos", $Language->MenuPhrase("2", "MenuText"), "cargoslist.php", -1, "", TRUE, FALSE, FALSE, "");
$RootMenu->AddMenuItem(3, "mi_ESCUELA", $Language->MenuPhrase("3", "MenuText"), "ESCUELAlist.php", -1, "", TRUE, FALSE, FALSE, "");
$RootMenu->AddMenuItem(4, "mi_localidades", $Language->MenuPhrase("4", "MenuText"), "localidadeslist.php", -1, "", TRUE, FALSE, FALSE, "");
$RootMenu->AddMenuItem(5, "mi_niveles", $Language->MenuPhrase("5", "MenuText"), "niveleslist.php", -1, "", TRUE, FALSE, FALSE, "");
$RootMenu->AddMenuItem(6, "mi_persona", $Language->MenuPhrase("6", "MenuText"), "personalist.php", -1, "", TRUE, FALSE, FALSE, "");
$RootMenu->AddMenuItem(7, "mi_niveles_Consulta", $Language->MenuPhrase("7", "MenuText"), "niveles_Consultalist.php", -1, "", TRUE, FALSE, FALSE, "");
$RootMenu->AddMenuItem(8, "mi_VER_FECHA_NIVEL_CLAVE_NOMBRE", $Language->MenuPhrase("8", "MenuText"), "VER_FECHA_NIVEL_CLAVE_NOMBRElist.php", -1, "", TRUE, FALSE, FALSE, "");
$RootMenu->AddMenuItem(9, "mi_mesa_nivel", $Language->MenuPhrase("9", "MenuText"), "mesa_nivellist.php", -1, "", TRUE, FALSE, FALSE, "");
$RootMenu->AddMenuItem(10, "mi_mesa", $Language->MenuPhrase("10", "MenuText"), "mesalist.php", -1, "", TRUE, FALSE, FALSE, "");
echo $RootMenu->ToScript();
?>
<div class="ewVertical" id="ewMenu"></div>
