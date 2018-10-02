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
<script type="text/javascript" src="js/jquery.mask.min.js"></script>
<script src="js/examples.js"></script>
<script src="js/edit.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
<script src="js/bootstrap.min.js"></script>
 <script language="javascript">
$(document).ready(function(){
    $("#busca").hide();
    $("#tabla").hide();
//HABILITA MENU ADMIN RECURSOS
    $("#recursos").on('click', function () {
       $("#titulo").html("ADMINISTRAR RECURSOS");
       $("#tabla").show();
       $("#name").val('');
       $("#result").html('');
    });

//BUSCADOR CUIL
        $("#name").keyup(function()
        {
        var name = $(this).val();
        if(name.length == 15)
        { 
            $("#tabla").hide();
            $("#result").html('buscando...');
        $.ajax({
            type : 'POST',
            url  : 'chequeo.php',
            data : $(this).serialize(),
            success : function(data)
                { 
                    $("#result").html(data);
/*                      console.log('encontre'); */
                 }
            });
           // return false;
        }else{
            
            // alert('debe seleccionar desde la tabla');
            //$("#busca").hide(); 
            $("#tabla").show();
        }

});


/*     $("#nivel").on('change', function () {
        $("#nivel option:selected").each(function () {
            elegido=$(this).val();
            $.post("curso.php", { elegido: elegido }, function(data) {
                $("#curso").html(data);
            });			
        });
   }); */ 
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
            <a class="nav-item nav-link" id="recursos" href="#">Nuevo</a>
        </div>
    </div>

</nav>
<div class="container">
    <h1>Sistema de Gestión Jefatura Distrital San Vicente</h1>

    <div class="card">
        <h5 class="card-header" id="titulo">SELECCIONAR MENU</h5>
        <div class="card-body">

            <div class="row">
                <div id="content" class="col-lg-12">
                 

                    <div id="busca">
                            <label for="name">C.U.I.T./C.U.I.L.:</label>
                            <input type="text" name="name" id="name" maxlength="150" size="20" 
                            class="inputstyle cuilt" placeholder="xx-xx.xxx.xxx-x" 
                            required=""
                            >
                    </div>
<!-- AGREGAR DE DATOS-->
    <table>
        <tr>
            <td>
            </td>
        </tr>
    </table>
<!-- FIN AGREGAR DE DATOS-->
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
                    <div id="result" class="col-lg-12">
                       
                    </div>
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
