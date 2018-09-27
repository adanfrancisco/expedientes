<html>
    <head>
	


<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>

		<script>
			$(document).ready(function () {
			$('#entradafilter').keyup(function () {
				//console.log($(this).val());
				var rex = new RegExp($(this).val(), 'i');
					$('.contenidobusqueda tr').hide();
					$('.contenidobusqueda tr').filter(function () {
						return rex.test($(this).text());
					}).show();

					})

			});
		</script>
	<meta charset="utf-8">


        <style type="text/css">
.btnx{
        font-size:15px;
        font-family:Verdana,Helvetica;
        font-weight:bold;
        float:none;
	    text-align:center;
        color:#638cb5;
        background:#aaff00;
        border:0px;
        width:80px;
        height:19px;
       }

.centerbtn{ 
    position:relative; 
    width:100%; left:0;
    text-align:center;
    margin:auto;
    /*position: relative; top: 50%; transform: translateY(-50%) translateX(30%); width: 100%;*/
}
</style>
   </head>     
<?php
    include "adodb5/adodb.inc.php";
    include "access_conn.php";

$fecha=(string)$_POST['fecha'];
$fecha2=$_POST['fecha2'];

    $db = new database();
    $db->conectar();


$fechaFFase="$fecha";
$posterior = new DateTime($fechaFFase);
//$posterior->modify('-1 day');
$posterior= $posterior->format('m/d/Y');

$fechaFFase2="$fecha2";
$anterior = new DateTime($fechaFFase2);
$anterior->modify('+1 day');
$anterior=$anterior->format('m/d/Y');


 /*$sql="SELECT * FROM niveles 
 INNER JOIN (ESCUELA INNER JOIN mesa ON ESCUELA.CLAVE = mesa.escuela) ON niveles.Id_nivel = ESCUELA.NIVEL 
 WHERE ((mesa.fecha)>#".$posterior."# And (mesa.fecha)<#".$anterior."#) order by mesa.fecha";
 */
$sql="SELECT OTRO.otro, *
FROM OTRO RIGHT JOIN (niveles INNER JOIN (ESCUELA INNER JOIN mesa ON ESCUELA.CLAVE = mesa.escuela) ON niveles.Id_nivel = ESCUELA.NIVEL) ON OTRO.id_mesa = mesa.Id
WHERE ((mesa.fecha)>#".$posterior."# And (mesa.fecha)<#".$anterior."#) order by mesa.fecha";

//echo $sql;


    $rs = $db->consulta($sql);

    ?>

<table border="1" ALIGN="CENTER" class="contenidobusqueda">
<div class="input-group"> <span class="input-group-addon">Filtrado</span>
    <input id="entradafilter" type="text" class="form-control">
</div>

        <th width=10% >Fecha</th> <th width=13%>CLAVE</th><th width=11%>ESCUELA</th><th width=65%>MENSAJE</th>
        <th width=10%>CARGO</th><th width=10%>DERIVADO</th>
    <?php
    while ( odbc_fetch_row($rs) ){

    echo '<tr><td> '.odbc_result($rs,"fecha").' </td>
    <td> '.odbc_result($rs,"escuela").'</td>';
    if(odbc_result($rs,"escuela")=='9999OO9999'){
        echo '<td> '.odbc_result($rs,"otro").' </td>';
    }else{
        echo '<td> '.odbc_result($rs,"nombre").'</td>' ;
    }
    
    echo '
    <td> '.odbc_result($rs,"mensaje").' </td>
    <td> '.odbc_result($rs,"atiende").' </td>
    <td> '.odbc_result($rs,"derivado").' </td>
    </tr>';
    }

    ?>

    </table>
    <br><br><br><br>
    <?php


    $db->desconectar();
    ?>
    