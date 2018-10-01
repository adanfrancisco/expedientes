<!DOCTYPE html PUBLIC '-//W3C//DTD XHTML 1.0 Strict//EN" 
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd'>
<html xmlns='http://www.w3.org/1999/xhtml' xml:lang='en' lang='en'>
    <head>
	
	<script type="text/javascript" src="http://code.jquery.com/jquery-2.1.1.js"></script>
		<script type="text/javascript" src="js/edit.js"></script>
		<script type="text/javascript" src="js/jquery.mask.min.js"></script>
		<script src="js/examples.js"></script>

	<meta charset="utf-8">
<?php

    include "../mesa/adodb5/adodb.inc.php";
    include "../mesa/access_conn.php";

#se crea instancia a clase
    $db = new database();
    $db->conectar();

if($_POST)
    {
        $dni = strip_tags($_POST['dni']);
       // echo 'el dni es: '.$dni;
    }


$sql="SELECT * FROM persona 
INNER JOIN localidades  
ON localidades.idLocalidad = persona.localidad 
where cuil = '".$dni."' and activo=2";

echo $sql;

echo '<br>busca2.php linea 19';
$rs = $db->consulta($sql);

?>

<br/>


   	<table id="tabla" border ="1">
    		<thead>
			<tr>
				<th class='
					<?php
						echo odbc_field_name($rs,"1");
					?>
				'>
					<?php
						echo odbc_field_name($rs,"1");
					?>
				</th>
				<th class='
					<?php
						echo odbc_field_name($rs,"2");
					?>
				'>
					<?php
						echo odbc_field_name($rs,"2");
					?>
			
				</th>					
				<th class='
					<?php
						echo odbc_field_name($rs,"3");
					?>
				'>
					<?php
						echo odbc_field_name($rs,"3");
					?>
			
				</th>
				<th class='
					<?php
						echo odbc_field_name($rs,"4");
					?>
				'>
					<?php
						echo odbc_field_name($rs,"4");
					?>
				</th>
				<th class='
					<?php
						echo odbc_field_name($rs,"5");
					?>
				'>
					<?php
						echo odbc_field_name($rs,"5");
					?>
				</th>
				<th class='
					<?php
						echo odbc_field_name($rs,"6");
					?>
				'>
					<?php
						echo odbc_field_name($rs,"6");
					?>
				</th>
				<th class='
					<?php
						echo odbc_field_name($rs,"7");
					?>
				'>
					<?php
						echo odbc_field_name($rs,"7");
					?>
				</th>
				<th class='
					<?php
						echo odbc_field_name($rs,"8");
					?>
				'>
					<?php
						echo odbc_field_name($rs,"8");
					?>
				</th>
				<th class='
					<?php
						echo odbc_field_name($rs,"9");
					?>
				'>
					<?php
						echo odbc_field_name($rs,"9");
					?>
				</th>
			</tr>

    		</thead>
    		<tbody>
    			<?php 
    				/* $sql = 'SELECT * FROM persona'; */
    				/* $rs = $db->consulta($sql); */
					while ( odbc_fetch_row($rs) ){
echo '<tr class="'.odbc_result($rs,"cuil").'">';
echo '<td class="'.odbc_result($rs,"cuil").' cuilt"name="'.odbc_field_name($rs,"1").'">'.odbc_result($rs,"cuil").'</td>';
echo '<td class="'.odbc_result($rs,"apellido").'" name="'.odbc_field_name($rs,"2").'">'.odbc_result($rs,"apellido").'</td>';
echo '<td class="'.odbc_result($rs,"nombre").'" name="'.odbc_field_name($rs,"3").'">'.odbc_result($rs,"nombre").'</td>';

///////////////////////////////COMBO EN CELDA /////////////////////////////////////

echo '<td class="'.odbc_result($rs,"localidad").'" name="'.odbc_field_name($rs,"4").'" data-id="'.odbc_result($rs,"localidad").'">'.odbc_result($rs,"localidad_nombre").'</td>';
echo '<td class="'.odbc_result($rs,"domicilio").'" name="'.odbc_field_name($rs,"5").'">'.odbc_result($rs,"domicilio").'</td>';
echo '<td class="'.odbc_result($rs,"telefono").' ttelefono" name="'.odbc_field_name($rs,"6").'">'.odbc_result($rs,"telefono").'</td>';
echo '<td class="'.odbc_result($rs,"celular").' ttelefono" name="'.odbc_field_name($rs,"7").'">'.odbc_result($rs,"celular").'</td>';
echo '<td class="'.odbc_result($rs,"email").'" name="'.odbc_field_name($rs,"8").'">'.odbc_result($rs,"email").'</td>';

$fecha = '';
if(odbc_result($rs,"fech_nac") != '')
$fecha=odbc_result($rs,"fech_nac");
	$fecha = date_format(date_create(odbc_result($rs,"fech_nac")), 'd-m-Y');

echo '<td class="'.$fecha.' datex" name="'.odbc_field_name($rs,"9").'">'. $fecha .'</td>';

echo '</tr>';
						}	
				?>
    		</tbody>
    	</table>
<script>
mostrar();
//editar_docente();

        mostrar_alta();

    </script>

    <?php
        //$db->desconectar();
  
?>