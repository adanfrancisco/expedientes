<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Sistema Integral</title>
<meta name="description" content="Sistema Integral - Jefatura Distrital"/>
<meta name="author" content="Adan Aloe">
<link rel="stylesheet" href="css/font-awesome.min.css">
<link rel="stylesheet" href="css/bootstrap.min.css">
<link rel="stylesheet" href="css/styles.css">

<script src="js/jquery.min.js"></script>


<!-- popup -->
   <!--  <link rel="stylesheet" href="popup/bundled.css"> -->
    <script src="popup/bundled.js"></script>
    <link rel="stylesheet" type="text/css" href="popup/jquery-confirm.css"/>     
    <script type="text/javascript"  src="popup/jquery-confirm.js"></script>
<!-- popup -->
<script type="text/javascript" src="js/jquery.mask.min.js"></script>
<script src="js/examples.js"></script>
<script src="js/edit.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
<script src="js/bootstrap.min.js"></script>


<script language="javascript">
$(document).ready(function(){

/* $.getJSON("localidadesX.php", function(data){
            localidades = data; */
                
$.getJSON('localidadesX.php', function(data) {
			$.each(data, function(key, value) {
				$(".selector-localidades").append('<option name="' + key + '">' + value + '</option>'); 
			}); // close each()
		});
});
</script>


</head>
<body>
    <label for="name">LOCALIDAD:</label>
        <select class="selector-localidades">
        <option>
        
        </option>
        </select>
</body>
</html>