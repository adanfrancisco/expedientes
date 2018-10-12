
		<?php 
		date_default_timezone_set('America/Los_Angeles');
			//include 'db.php';
			//$sql = 'SELECT * FROM persona INNER JOIN localidades  ON localidades.idLocalidad = persona.localidad where persona.activo=2 order by apellido';
 			$sql = 'SELECT niveles.nivel, ESCUELA.CLAVE, cargos.cargo, persona.apellido, 
			 persona.nombre, persona.telefono, persona.celular, persona.email
			 FROM persona INNER JOIN ((niveles INNER JOIN ESCUELA ON niveles.id_nivel = ESCUELA.NIVEL) 
			 INNER JOIN (cargos INNER JOIN SERVICIOS ON cargos.id_cargo = SERVICIOS.cargo) 
			 ON ESCUELA.CLAVE = SERVICIOS.escuela) ON persona.cuil = SERVICIOS.persona			 
			 where persona.activo=2 order by niveles.nivel'; 
			$rs = $db->consulta($sql);
		?>
		
<div class="input-group"> <span class="input-group-addon">BUSCAR</span>
    <input id="entradafilter" type="text" class="form-control">
</div>


    	<table id="tabla" border ="1" class="contenidobusqueda">
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
				<th class='
					<?php
						echo odbc_field_name($rs,"8");
					?>
				'>
					<?php
						echo odbc_field_name($rs,"8");
					?>			
				</th>								
			</tr>

    		</thead>
    		<tbody>
    			<?php 

					while ( odbc_fetch_row($rs) ){
echo '<tr class="'.odbc_result($rs,"nivel").'">';
echo '<td class="'.odbc_result($rs,"nivel").' "name="'.odbc_field_name($rs,"1").'">'.odbc_result($rs,"nivel").'</td>';
echo '<td class="'.odbc_result($rs,"clave").' "name="'.odbc_field_name($rs,"2").'">'.odbc_result($rs,"clave").'</td>';
echo '<td class="'.odbc_result($rs,"cargo").' "name="'.odbc_field_name($rs,"3").'">'.odbc_result($rs,"cargo").'</td>';
echo '<td class="'.odbc_result($rs,"apellido").' "name="'.odbc_field_name($rs,"4").'">'.odbc_result($rs,"apellido").'</td>';
echo '<td class="'.odbc_result($rs,"nombre").' "name="'.odbc_field_name($rs,"5").'">'.odbc_result($rs,"nombre").'</td>';
echo '<td class="'.odbc_result($rs,"telefono").' "name="'.odbc_field_name($rs,"6").'">'.odbc_result($rs,"telefono").'</td>';
echo '<td class="'.odbc_result($rs,"celular").' "name="'.odbc_field_name($rs,"7").'">'.odbc_result($rs,"celular").'</td>';
echo '<td class="'.odbc_result($rs,"email").' "name="'.odbc_field_name($rs,"8").'">'.odbc_result($rs,"email").'</td>';


echo '</tr>';
						}	
				?>
    		</tbody>
    	</table>

