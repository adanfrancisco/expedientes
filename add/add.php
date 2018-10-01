<script>
function esCUITValido(inputValor) {
    inputString = inputValor.toString()
    if (inputString.length == 11) {
        var Caracters_1_2 = inputString.charAt(0) + inputString.charAt(1)
        if (Caracters_1_2 == "20" || Caracters_1_2 == "23" || Caracters_1_2 == "24" || Caracters_1_2 == "27" || Caracters_1_2 == "30" || Caracters_1_2 == "33" || Caracters_1_2 == "34") {
            var Count = inputString.charAt(0) * 5 + inputString.charAt(1) * 4 + inputString.charAt(2) * 3 + inputString.charAt(3) * 2 + inputString.charAt(4) * 7 + inputString.charAt(5) * 6 + inputString.charAt(6) * 5 + inputString.charAt(7) * 4 + inputString.charAt(8) * 3 + inputString.charAt(9) * 2 + inputString.charAt(10) * 1
            Division = Count / 11;
            if (Division == Math.floor(Division)) {
                return true
            }
        }
    }
    return false
}


    $("#actualizar").click(function() 
    {
      //
      alert('actualizar');


    })

    $("#grabar").click(function() 
    {
      alert('grabar');
    })

  
</script>

<!DOCTYPE html>
  <html>
    <head>
      <!--Import Google Icon Font-->
      <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
      <link type="text/css" rel="stylesheet" href="css/estilo.css"  media="screen,projection"/>
      <link rel="stylesheet" href="https://yandex.st/highlightjs/7.3/styles/default.min.css">
      <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
      <script type="text/javascript" src="http://code.jquery.com/jquery-2.1.1.js"></script>
      <script async defer src="https://buttons.github.io/buttons.js"></script>
    </head>

<body id="fondo">
<?php
if($_POST['existe']!=1){
  //////////////////////////si existe
///////////////////////// lo edito
echo $_POST['existe'];
?>
<script>console.log('existeeee');</script>


///aca deberia hacer la rutina para levantar en pos del dni//

<div class="container center-align">
    <div class="input-field col s6">
      <label for="dni">DOCUMENTO</label>
      <input placeholder="XX-XX.XXX.XXX-X" id="dni" type="text" class="dni"
      onfocus="this.value=''";
      value='
      <?php
      echo $_POST['dni'];
      ?>
      '
      >
    </div>
    <BR>
    <div class="input-field col s6">
      <label for="apellido">APELLIDO</label>
      <input placeholder="APELLIDO" id="apellido" type="text" class="validate" 
      value='
      <?php
      echo $_POST['apellido'];
      ?>
      '
      style="text-transform:uppercase";
      onkeyup="javascript:this.value=this.value.toUpperCase();" 
      onfocus="this.value=''";
       >   
    </div>
    <BR>
    <div class="input-field col s6">
      <label for="nombre">NOMBRE</label>
      <input placeholder="NOMBRE" id="nombre" type="text" class="validate"
      style="text-transform:uppercase";
      onkeyup="javascript:this.value=this.value.toUpperCase();" 
      onfocus="this.value=''";
      value='
      <?php
      echo $_POST['nombre'];
      ?>
      '>   
    </div>
    <BR>
    <div class="input-field col s6">
      <label for="domicilio">DOMICILIO</label>
      <input placeholder="DOMICILIO" id="domicilio" type="text" class="validate"
      style="text-transform:uppercase";
      onkeyup="javascript:this.value=this.value.toUpperCase();" 
      onfocus="this.value=''";
      value='
      <?php
      echo $_POST["domicilio"];
      ?>
      '> 
    </div>
          <?php
          include "../mesa/adodb5/adodb.inc.php";
          include "../mesa/access_conn.php";

          #se crea instancia a clase
          $db = new database();
          $db->conectar();

          $sql="SELECT * from localidades order by localidad_nombre";
              $rs = $db->consulta($sql);
              echo '<br/>';
              ?>
              <div class="input-field col s6">
              <label for="localidad">LOCALIDAD</label>
              <select id="localidad" name="localidad">
                  
              <?php
              while ( odbc_fetch_row($rs) ){
              echo '
              <option value=""> '.odbc_result($rs,"localidad_nombre").'</option>'; }
              ?>
              </select>
</div>
  <div class="input-field col s6">
      <label for="email">EMAIL</label>
      <input placeholder="EMAIL" id="email" type="text" class="validate"
      style="text-transform:uppercase";
      onkeyup="javascript:this.value=this.value.toLowerCase();" 
      value='
      <?php
      echo $_POST['email'];
      ?>
      '> 
    </div>
    <BR>
    <div class="input-field col s6">
      <label for="telfijo">TEL.FIJO</label>
      <input class="phone_with_ddd" placeholder="11-XXXX.XXXX" id="telfijo" type="text" class="validate"
      onfocus="this.value=''";
      value='
      <?php
      echo $_POST['telefono'];
      ?>
      '>
    </div>
    <BR>
    <div class="input-field col s6">
            <label for="telcelu">TEL.CELULAR</label>
            <input type="text" class="phone_with_ddd" id="telcelu"
            onfocus="this.value=''";
            value='
      <?php
      echo $_POST['celular'];
      ?>
      '>
          </div>

    <BR>
    <button id="actualizar">ACTUALIZAR &nbsp;</button>
</div>







<?php
}else{
//////////////////////////si no existe
///////////////////////// lo agrego
echo $_POST['existe'];

?>
<script>alert('lo tengo que agregar / add.php 187');
  console.log('como no existe lo agrego');
</script>


<?php
}
?>

<!-- <script src="https://yandex.st/highlightjs/7.3/highlight.min.js"></script> -->
<script type="text/javascript" src="https://code.jquery.com/jquery-latest.min.js"></script>
<script type="text/javascript" src="js/jquery.mask.min.js"></script>
<script src="js/examples.js"></script>


</body>
</html>
        