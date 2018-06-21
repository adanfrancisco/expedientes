
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Mesa de Entradas</title>
 
    <link href="css/bootstrap.min.css" rel="stylesheet" media="screen">
    <!-- librerías opcionales que activan el soporte de HTML5 para IE8 -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
  <body>
    <h1 align ="center">SELECCIONE</h1>

    <div id="niveles">
        <button type="button" id="btn_inicial">todos</button>
        <button type="button" class="btn btn-primary">INICIAL</button>
        <button type="button" class="btn btn-secondary">PRIMARIA</button>
        <button type="button" class="btn btn-success">SECUNDARIA</button>

        <button type="button" class="btn btn-info">AGRARIA</button>
        <button type="button" class="btn btn-secondary">TECNICA</button>

        <button type="button" class="btn btn-dark">ESPECIAL</button>
        <button type="button" class="btn btn-secondary">ARTISTICA</button>
        <button type="button" class="btn btn-danger">ADULTOS</button>
        <button type="button" class="btn btn-warning">EDUC.FISICA</button>
        <button type="button" class="btn btn-warning">PSICOLOGIA</button>
    </div>
    <!-- Librería jQuery requerida por los plugins de JavaScript -->
    <script src="http://code.jquery.com/jquery.js"></script>
 
    <!-- Todos los plugins JavaScript de Bootstrap (también puedes
         incluir archivos JavaScript individuales de los únicos
         plugins que utilices) -->
    <script src="js/bootstrap.min.js">
   
    
//PRIMER DESARROLLO DE USUARIO Y CLAVE
$("#cambia_clave").on( "click", function() {    
    $('btn_inicial').toggle("swing");
    $('#niveles').hide();
    
     });    
    
    </script>

    <?php
    include "adodb5/adodb.inc.php";
    include "access_conn.php";
    #se crea instancia a clase
    $db = new database();
    $db->conectar();

    #Se realiza consulta
    $rs = $db->consulta( " SELECT *FROM niveles INNER JOIN ESCUELA ON niveles.Id_nivel = ESCUELA.NIVEL
 WHERE niveles.nivel='INICIAL'" );
    #Se imprimen los datos
    echo "  <br/>";
    ?>

    <table border="1" ALIGN="CENTER">
        <th>NIVEL</th> <th>SERVICIO</th><th>CLAVE</th><th>CUE</th><th>DOMICILIO</th><th>TELEFONO</th>
    <?php
    while ( odbc_fetch_row($rs) )

        C
    ?>

    </table>
    <?php


    $db->desconectar();
    ?>
  </body>
</html>