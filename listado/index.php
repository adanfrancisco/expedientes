<!DOCTYPE HTML>
<html lang="es">
    <head>
        <meta charset="utf-8"/>
        <title>MESA</title>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script> 
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>
        <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css" rel="stylesheet">
 
        <script type="text/javascript">
           $(document).ready(function(e)
           {  
                    $(".servicios").hide();
                    $("#modalidades").hide();

                    $('.inicio').click(function(){
                            $(".servicios").toggleClass("show");});
                    $('.modalidades').click(function(){
                            $("#modalidades").toggleClass("show");});

            //imprimo las entradas
            $('.inicial').click(function(){
                var fecha=$("#dia_inicio").val()+"-"+$("#mes_inicio").val()+"-"+$("#anio_inicio").val();
                
                //envio la fecha al post    
                console.log(fecha);
                        var fecha=fecha;
                        $.post("grabar.php", { 
                            fecha: fecha },
                        function(data){$("#listados").html(data);}); 

             });

});
</script>

<style type="text/css">
  body {
    color: purple;
    background-color: #d8da3d }

.inputstyle {
    font-family: Arial; 
    font-size: 20pt; 
    ;
    }
.btn{font-family: Arial; font-size: 18pt; }

</style>

    </head>
    <body>
      <div class="col-lg-10">
                            <div id="fecha_inicio">
                                <select name="dia" id="dia_inicio">
                                    <?php
                                    for ($i=1; $i<=31; $i++) {
                                        if ($i == date('j'))
                                            echo '<option value="'.$i.'" selected>'.$i.'</option>';
                                        else
                                            echo '<option value="'.$i.'">'.$i.'</option>';
                                    }
                                    ?>
                            </select>
                            <select name="mes" id="mes_inicio">
                                    <?php
                                    for ($i=1; $i<=12; $i++) {
                                        if ($i == date('m'))

                                            echo '<option value="'.$i.'" selected>'.$i.'</option>';
                                        else
                                            echo '<option value="'.$i.'">'.$i.'</option>';
                                    }
                                    ?>
                            </select>
                            <select name="ano" id="anio_inicio">
                                    <?php
                                    for($i=date('o'); $i>=1910; $i--){
                                        if ($i == date('o'))
                                            echo '<option value="'.$i.'" selected>'.$i.'</option>';
                                        else
                                            echo '<option value="'.$i.'">'.$i.'</option>';
                                    }
                                    ?>


                            </select>
                            </div>          


      <br/>
        <button type="button" class="btn btn-primary inicio">LISTADOS</button>
        <hr>




       <div class="col-lg-20 servicios">
  
        <button type="button" class="btn btn-primary inicial">INICIAL</button>
        <button type="button" class="btn btn-secondary primaria">PRIMARIA</button>
        <button type="button" class="btn btn-success secundaria">SECUNDARIA</button>
        <button type="button" class="btn btn-warning superior">SUPERIOR</button>
        <button type="button" class="btn btn-info agraria">AGRARIA</button>
        <button type="button" class="btn btn-secondary tecnica">TECNICA</button>
        <button type="button" class="btn btn-secondary modalidades">MODALIDADES</button>
    </div>
<hr>
         <div id="modalidades">
                <button type="button" class="btn btn-dark EEE501">ESPECIAL</button>
                <button type="button" class="btn btn-secondary EEEA1">ARTISTICA</button>
                <button type="button" class="btn btn-danger EEPA-701">ADULTOS</button>


<!--                 <button type="button" class="btn btn-danger EEPA-701">ADULTOS-EEPA-701</button>
                <button type="button" class="btn btn-danger CEA702">SEC-ADULTOS-702</button>
                <button type="button" class="btn btn-danger CEA703">SEC-ADULTOS-703</button>
                <button type="button" class="btn btn-danger CEA704">SEC-ADULTOS-704</button>
                <button type="button" class="btn btn-warning CENS451">SEC-ADULTOS-CENS-451</button>
                <button type="button" class="btn btn-warning CENS452">SEC-ADULTOS-CENS-452</button>
                <button type="button" class="btn btn-warning CENS453">SEC-ADULTOS-CENS-453</button>
                <button type="button" class="btn btn-secondary CEF93">CEF93</button> -->

                
                <button type="button" class="btn btn-info CFP401">FORMACION-PROFESIONAL</button>
                <button type="button" class="btn btn-danger CIIE200">CIE</button>
                <hr>
         </div>

<div id="listados">


</div>

    </body>
</html>