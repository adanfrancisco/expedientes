<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>MESA-Alta de Personas</title>
        <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>
        <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css" rel="stylesheet">
		<script type="text/javascript" src="js/edit.js"></script>
		<script type="text/javascript" src="js/jquery.mask.min.js"></script>
		<script src="js/examples.js"></script>

<script type="text/javascript">
$(document).ready(function()
{
   
$("#btn_alta").click(function() 
{
    //mensaje();
    ingresar_nuevo_docente();
    console.log("diste click al boton AGREGAR");
    //location.reload();
});

$("#btn_editar").click(function() 
    {
        //levanto el valor del radio en caso que haya mas de una coincidencia
        alert($('input:radio[name=dni]:checked').val()+'\nindex 25');
    var dni=$('input:radio[name=dni]:checked').val()
        //envio la consulta
        console.log("editar index.php 28");


        editar_me(dni);

    });

$("#btn_usar").click(function() 
    {
        console.log("usar");
        //ingresar();
        //location.reload();
    });

$('#botones').hide();
$('#btn_alta').hide();

    $("#name").keyup(function()
        {  var name = $(this).val();
        if(name.length > 2)
        {   $("#result").html('buscando...');
        $.ajax({
            type : 'POST',
            url  : 'chequeo.php',
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
            <label for="name">APELLIDO:</label>
                <input type="text" name="name" id="name" maxlength="150" size="20" 
                class="inputstyle" placeholder="APELLIDO" 
                style="text-transform:uppercase;" 
                onkeyup="javascript:this.value=this.value.toUpperCase();" 
                onfocus="javascript:this.value='';" 
                required=""
                >

                <span class="retorno" id="result"></span>
            </div>
            <div id="botones">

                <button type="button" id="btn_usar" class="btn btn-primary usar">USAR</button>
                <button type="button" id="btn_editar" class="btn btn-secondary editar">EDITAR</button>
            </div>
            <button type="button" id="btn_alta" class="btn btn-primary alta">AGREGAR</button>
        </fieldset>
    </form>

</div>
<?php
            include ('js/funciones_js.php');
            
            ?>
</body>
</html>