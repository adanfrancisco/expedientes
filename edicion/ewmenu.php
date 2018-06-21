<?php

// Menu
$RootMenu = new cMenu("RootMenu", TRUE);
$RootMenu->AddMenuItem(1, "mi_SERVICIOS", $Language->MenuPhrase("1", "MenuText"), "SERVICIOSlist.php", -1, "", TRUE, FALSE, FALSE, "");
$RootMenu->AddMenuItem(2, "mi_cargos", $Language->MenuPhrase("2", "MenuText"), "cargoslist.php", -1, "", TRUE, FALSE, FALSE, "");
$RootMenu->AddMenuItem(3, "mi_ESCUELA", $Language->MenuPhrase("3", "MenuText"), "ESCUELAlist.php", -1, "", TRUE, FALSE, FALSE, "");
$RootMenu->AddMenuItem(4, "mi_localidades", $Language->MenuPhrase("4", "MenuText"), "localidadeslist.php", -1, "", TRUE, FALSE, FALSE, "");
$RootMenu->AddMenuItem(5, "mi_niveles", $Language->MenuPhrase("5", "MenuText"), "niveleslist.php", -1, "", TRUE, FALSE, FALSE, "");
$RootMenu->AddMenuItem(6, "mi_persona", $Language->MenuPhrase("6", "MenuText"), "personalist.php", -1, "", TRUE, FALSE, FALSE, "");
echo $RootMenu->ToScript();
?>
<div class="ewVertical" id="ewMenu"></div>
