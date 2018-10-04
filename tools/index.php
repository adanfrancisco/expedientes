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
    $("#busca").hide();
    $("#alta").hide();
    $("#tabla").hide();
//HABILITA MENU ADMIN RECURSOS
    $("#recursos").on('click', function () {
       $("#titulo").html("ADMINISTRAR RECURSOS");
//       $("#resulta").hide();
    $("#busca").show();
    $("#alta").hide();
       $("#tabla").show();
       $("#name").val('');
       $("#result").html('');
       $("#resulta").html('');
    });

//BUSCADOR CUIL
        $("#name").keyup(function()
        {
        var name = $(this).val();
        if(name.length == 8)
        { 
            $("#tabla").hide();
            $("#result").html('buscando...');
        $.ajax({
            type : 'POST',
            url  : 'chequeo.php',
            data : $(this).serialize(),
            success : function(data)
                { 
                    $("#resulta").html(data);
                    $("#result").html('');
                    //$("#busca").hide()
                 }
            });
        }else{
            $("#tabla").show();
        }

});

$("#nuevo_registro").click(function()

    {

    $("#busca").hide();
    $("#alta").show();
    $("#tabla").hide();
    $("#result").hide();
    $("#resulta").hide();
    $('#cuil').val('');
    $('#apellido').val('');
    $('#nombre').val('');
    });

$("#btn_guardar_nuevo").click(function(){
$("#result").show();
        var dni=$('input:text[name=dni]').val();
       // var cuil=$('input:text[name=cuil]').val();
        var apellido=$('input:text[name=apellido]').val();
        var nombre=$('input:text[name=nombre]').val();
///////////////////  localidad - levanto el atributo name :)
var localidadX =$('option:selected', ".selector-localidades").attr('name');
///////////////////  localidad
        var domicilio=$('input:text[name=domicilio]').val();
        var telfijo=$('input:text[name=telfijo]').val();
        var telcel=$('input:text[name=telcel]').val();
        var email=$('input:text[name=email]').val();
        var fecha=$('input:text[name=fecha]').val();
        
//INICIO RUTINA POPUP
            $.confirm({
                title: 'Confirme!',
                content: 
                '<BR><b>D.N.I.:</b>'+dni
                +'<BR> <b>APELLIDO:</b> '+apellido
                +'<BR> <b>NOMBRE:</b>'+nombre 
                + '<BR> <b>localidad:</b>'+localidadX
                +'<BR> Domicilio: '+domicilio + '<br>TEL:'+ telfijo +
                '<br>CEL:'+telcel +'<br>email: '+email + '<br>Fecha:'+fecha
                ,
                buttons: {
                    SI: function () {
                        $.alert('GUARDADO!');
            //****************************************************************************/

$.post (
    "nuevo_registro.php", {
        dni:dni,
        apellido:apellido,
        nombre:nombre,
        localidad:localidadX,
        domicilio:domicilio,
        telfijo:telfijo,
        telcel:telcel,
        email:email,
        fecha,fecha
    },

    function(data){
    $("#busca").hide();
    $("#alta").hide();
    $("#tabla").hide();
        $("#result").html(data);

    });
   
/*     function () {
        console.log ('se guardo');
    }); */

//***********************************************************************************************
                    },
                    NO: function () {
                        $.alert('No se guardo!');
                        console.log('NO SE HA ALMACENADO....');
                    },
                }
            });
//FIN RUTINA POPUP
});

//BUSCA EN TABLA


    $('#entradafilter').keyup(function () {
        var rex = new RegExp($(this).val(), 'i');
            $('.contenidobusqueda tr').hide();
            $('.contenidobusqueda tr').filter(function () {
                return rex.test($(this).text());
            }).show();

            })

    $("#area_tabla table tr td").click(function() {
        var celda = $(this);
        ///alert(celda.html());
        $("#busca").show();
      });

///carga combo localidades
$.getJSON('localidadesX.php', function(data) {
			$.each(data, function(key, value) {
				$(".selector-localidades").append('<option name="' + key + '">' + value + '</option>'); 
			}); // close each()
		});
});



</script>


</head>

<body>
<nav class="navbar navbar-expand-lg fixed-top navbar-dark bg-dark">

    <a class="navbar-brand" href="http://localhost/">
        <img src="img/adan-aloe.png" width="30" height="30" alt="Adan Aloe">
      </a>

    <button class="navbar-toggler" 
    type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" 
    aria-controls="navbarNavAltMarkup" aria-expanded="false" 
    aria-label="Toggle navigation">

        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
        <div class="navbar-nav">
            <a class="nav-item nav-link" id="recursos" href="#">Gestion de Recursos</a>
            <a class="nav-item nav-link" id="nuevo_registro" href="#">Nuevo</a>
        </div>
    </div>

</nav>
<div class="container">
    <h1>Sistema de Gestión Jefatura Distrital San Vicente</h1>

    <div class="card">
        <h5 class="card-header" id="titulo">SELECCIONAR MENU</h5>
        <div class="card-body">
        <div id="resulta" class="col-lg-12"></div>
            <div class="row">
                <div id="content" class="col-lg-12">
                 <DIV id="alta">
                 <label for="name">D.N.I.:</label>
                            <input type="text" name="dni" id="dni" maxlength="150" size="20" 
                            class="inputstyle" placeholder="xx.xxx.xxx" 
                            required=""
                            >

 <!--                 <label for="name">DNI.:</label>
                            <input type="text" name="cuil" id="cuil" maxlength="150" size="20" 
                            class="inputstyle cuilt" placeholder="xx-xx.xxx.xxx-x" 
                            required=""
                            > -->
                        <label for="name">APELLIDO:</label>
                            <input type="text" name="apellido" id="apellido" maxlength="150" size="20" 
                            class="inputstyle" placeholder="APELLIDO" 
                            style="text-transform:uppercase;" 
						    onkeyup="javascript:this.value=this.value.toUpperCase();
                            required=""
                            >
                            <br>                            
                            <label for="name">NOMBRE:</label>
                            <input type="text" name="nombre" id="nombre" maxlength="150" size="20" 
                            class="inputstyle" placeholder="NOMBRE" 
                            style="text-transform:uppercase;" 
						    onkeyup="javascript:this.value=this.value.toUpperCase();                            
                            required=""
                            >   
                            

                            <label for="name">LOCALIDAD:</label>
                            <select class="selector-localidades" name="localidad" id="localidad">
                                <option></option>
                            </select>

                            <label for="name">DOMICILIO:</label>
                            <input type="text" name="domicilio" id="domicilio" maxlength="500" size="20" 
                            class="inputstyle" placeholder="NOMBRE" 
                            style="text-transform:uppercase;" 
						    onkeyup="javascript:this.value=this.value.toUpperCase();                            
                            required=""
                            > 
                            <br>
                            <label for="name">TELEFONO FJO:</label>
                            <input type="text" name="telfijo" id="telfijo" maxlength="150" size="20" 
                            class="inputstyle ttelefono" placeholder="NOMBRE" 
                            style="text-transform:uppercase;" 
						    onkeyup="javascript:this.value=this.value.toUpperCase();                            
                            required=""
                            > 
                            <label for="name">TELEFONO CEL:</label>
                            <input type="text" name="telcel" id="telcel" maxlength="150" size="20" 
                            class="inputstyle ttelefono" placeholder="NOMBRE" 
                            style="text-transform:uppercase;" 
						    onkeyup="javascript:this.value=this.value.toUpperCase();                            
                            required=""
                            > 
                            <label for="name">EMAIL:</label>
                            <input type="text" name="email" id="email" maxlength="150" size="20" 
                            class="inputstyle" placeholder="NOMBRE" 
                            style="text-transform:lowercase;" 
						    onkeyup="javascript:this.value=this.value.toLowerCase();                            
                            required=""
                            > 
                            <br>
                            <label for="name">FECHA:</label>
                            <input type="text" name="fecha" id="fecha" maxlength="150" size="20" 
                            class="inputstyle datex" placeholder="NOMBRE" 
						    onKeyUp = "this.value=formateafecha(this.value);"                            
                            required=""
                            >   

<!-- <input name="fechan" id="fechan" 
class="input-text align-center" 
style="padding: 0; width: 260px" type="text" id="clave" value="" maxlength="10" 
placeholder="NACIO EL 17/11/1973" style="text-transform:uppercase;" 
onKeyUp = "this.value=formateafecha(this.value);" onfocus="javascript:this.value='';"
required="">  -->                            
                            
                            
                            
                                                                                 <br>
                            <button type="button" id="btn_guardar_nuevo" class="btn btn-primary usar">GUARDAR</button>                      
                 </DIV>

                <div id="busca">
                        <label for="name">D.N.I.:</label>
                        <input type="text" name="name" id="name" maxlength="150" size="20" 
                        class="inputstyle" placeholder="xx.xxx.xxx" 
                        required=""
                        >
                        
                        <button type="button" id="btn_usar" class="btn btn-primary usar pull-right">USAR</button>
                </div>

                <div id="tabla">
                <?php
                    require('table.php')
                ?>
                </div>

                </div>
            </div>
        </div>
        <div id="card-title">
            <div id="row">
                    <div id="result" class="col-lg-12"></div>
            </div>
        </div>

    </div>

    <div class="footer-content row">
        <div class="col-lg-12">
            <div class="pull-right">
.
            </div>
        </div>
    </div>
    
</div>
<footer class="footer bg-dark">
    <div class="container">
        <span class="text-muted"><a href="https://www.adanaloe.com/">&copy; Adán Aloe</a></span>
    </div>
</footer>
</body>
</html>
