<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>MESA-Alta de Personas</title>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script> 
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>
        <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css" rel="stylesheet">

<script type="text/javascript">
$(document).ready(function()
{
   

$("#editar").click(function() 
    {
        console.log("editar");
        //ingresar();
        //location.reload();
    });

$("#usar").click(function() 
    {
        console.log("usar");
        //ingresar();
        //location.reload();
    });

$('#botones').hide();

    $("#name").keyup(function()
        {  var name = $(this).val();
        if(name.length > 2)
        {   $("#result").html('buscando...');
        $.ajax({
            type : 'POST',
            url  : 'username-check.php',
            data : $(this).serialize(),
            success : function(data)
                { 
                    $("#result").html(data);
                     console.log('encontre');
                 }
            });
           // return false;
        }

});});
</script>
</head>

<body>
<div id="cuerpo">

    <form id="reg-form" action="" method="post" autocomplete="off">
        <fieldset>
            <div>
                <input type="text" name="name" id="name" maxlength="150" size="20" class="inputstyle" placeholder="APELLIDO" style="text-transform:uppercase;" onkeyup="javascript:this.value=this.value.toUpperCase();" onfocus="javascript:this.value='';" required="">
                <span class="retorno" id="result"></span>
            </div>
            <div id="botones">
                <button type="button" id="usar" class="btn btn-primary usar">USAR</button>
                <button type="button" id="editar" class="btn btn-secondary editar">EDITAR</button>
            </div>
        </fieldset>
    </form>

</div>
<?php
			include 'funciones_js.php';?>
</body>
</html>