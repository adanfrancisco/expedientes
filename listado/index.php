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
var exporta;            
exporta=0;
$("input[type=radio]").change(function(){
    exporta=($("input[name="+ this.name + "]:checked").val());
    //alert( $("input[type=radio][name="+ this.name + "]").val() );
});


            $('.inicial').click(function(){
            

             });
            $('.inicial').click(function(){
                if( $("#modalidades").is(":visible") ){
                         $("#modalidades").toggleClass("show");
                    }
                var fecha=$("#dia_inicio").val()+"-"+$("#mes_inicio").val()+"-"+$("#anio_inicio").val();
                var fecha2=$("#dia_inicio2").val()+"-"+$("#mes_inicio2").val()+"-"+$("#anio_inicio2").val();
                //envio la fecha al post    
                
                console.log(fecha+' ' +exporta);
                        var fecha=fecha;
                        var nivel='INICIAL';
                        $.post("grabar.php", { 
                            fecha: fecha,
                            nivel:nivel },
                        function(data){$("#listados").html(data);}); 

             });

             $('.primaria').click(function(){
                if( $("#modalidades").is(":visible") ){
                         $("#modalidades").toggleClass("show");
                    }
                var fecha=$("#dia_inicio").val()+"-"+$("#mes_inicio").val()+"-"+$("#anio_inicio").val();
                var fecha2=$("#dia_inicio2").val()+"-"+$("#mes_inicio2").val()+"-"+$("#anio_inicio2").val();
                //envio la fecha al post    
                console.log(fecha);
                        var fecha=fecha;
                        var nivel='PRIMARIA';
                        $.post("grabar.php", { 
                            fecha: fecha,
                            nivel:nivel },
                        function(data){$("#listados").html(data);}); 

             });
             $('.secundaria').click(function(){
                if( $("#modalidades").is(":visible") ){
                         $("#modalidades").toggleClass("show");
                    }
                var fecha=$("#dia_inicio").val()+"-"+$("#mes_inicio").val()+"-"+$("#anio_inicio").val();
                var fecha2=$("#dia_inicio2").val()+"-"+$("#mes_inicio2").val()+"-"+$("#anio_inicio2").val();
                //envio la fecha al post    
                console.log(fecha);
                        var fecha=fecha;
                        var nivel='SECUNDARIA';
                        $.post("grabar.php", { 
                            fecha: fecha,
                            nivel:nivel },
                        function(data){$("#listados").html(data);}); 

             });

             $('.superior').click(function(){
                if( $("#modalidades").is(":visible") ){
                         $("#modalidades").toggleClass("show");
                    }
                var fecha=$("#dia_inicio").val()+"-"+$("#mes_inicio").val()+"-"+$("#anio_inicio").val();
                var fecha2=$("#dia_inicio2").val()+"-"+$("#mes_inicio2").val()+"-"+$("#anio_inicio2").val();
                //envio la fecha al post    
                console.log(fecha);
                        var fecha=fecha;
                        var nivel='SUPERIOR';
                        $.post("grabar.php", { 
                            fecha: fecha,
                            nivel:nivel },
                        function(data){$("#listados").html(data);}); 

             });

             $('.agraria').click(function(){
                if( $("#modalidades").is(":visible") ){
                         $("#modalidades").toggleClass("show");
                    }
                var fecha=$("#dia_inicio").val()+"-"+$("#mes_inicio").val()+"-"+$("#anio_inicio").val();
                var fecha2=$("#dia_inicio2").val()+"-"+$("#mes_inicio2").val()+"-"+$("#anio_inicio2").val();
                //envio la fecha al post    
                console.log(fecha);
                        var fecha=fecha;
                        var nivel='AGRARIA';
                        $.post("grabar.php", { 
                            fecha: fecha,
                            nivel:nivel },
                        function(data){$("#listados").html(data);}); 
             });


             $('.tecnica').click(function(){

                    if( $("#modalidades").is(":visible") ){
                         $("#modalidades").toggleClass("show");
                    }

                var fecha=$("#dia_inicio").val()+"-"+$("#mes_inicio").val()+"-"+$("#anio_inicio").val();
                var fecha2=$("#dia_inicio2").val()+"-"+$("#mes_inicio2").val()+"-"+$("#anio_inicio2").val();
                //envio la fecha al post    
                console.log(fecha);
                        var fecha=fecha;
                        var nivel='TECNICA';
                        $.post("grabar.php", { 
                            fecha: fecha,
                            nivel:nivel },
                        function(data){$("#listados").html(data);}); 
             });

             $('.especial').click(function(){
                var fecha=$("#dia_inicio").val()+"-"+$("#mes_inicio").val()+"-"+$("#anio_inicio").val();
                var fecha2=$("#dia_inicio2").val()+"-"+$("#mes_inicio2").val()+"-"+$("#anio_inicio2").val();
                //envio la fecha al post    
                console.log(fecha);
                        var fecha=fecha;
                        var nivel='ESPECIAL';
                        $.post("grabar.php", { 
                            fecha: fecha,
                            nivel:nivel },
                        function(data){$("#listados").html(data);}); 
             });
             $('.artistica').click(function(){
                var fecha=$("#dia_inicio").val()+"-"+$("#mes_inicio").val()+"-"+$("#anio_inicio").val();
                var fecha2=$("#dia_inicio2").val()+"-"+$("#mes_inicio2").val()+"-"+$("#anio_inicio2").val();
                //envio la fecha al post    
                console.log(fecha);
                        var fecha=fecha;
                        var nivel='ARTISTICA';
                        $.post("grabar.php", { 
                            fecha: fecha,
                            nivel:nivel },
                        function(data){$("#listados").html(data);}); 
             });
             $('.adultos').click(function(){
                var fecha=$("#dia_inicio").val()+"-"+$("#mes_inicio").val()+"-"+$("#anio_inicio").val();
                var fecha2=$("#dia_inicio2").val()+"-"+$("#mes_inicio2").val()+"-"+$("#anio_inicio2").val();
                //envio la fecha al post    
                console.log(fecha);
                        var fecha=fecha;
                        var nivel='ADULTOS';
                        $.post("grabar.php", { 
                            fecha: fecha,
                            nivel:nivel },
                        function(data){$("#listados").html(data);}); 
             });
             $('.fp').click(function(){
                var fecha=$("#dia_inicio").val()+"-"+$("#mes_inicio").val()+"-"+$("#anio_inicio").val();
                var fecha2=$("#dia_inicio2").val()+"-"+$("#mes_inicio2").val()+"-"+$("#anio_inicio2").val();
                //envio la fecha al post    
                console.log(fecha);
                        var fecha=fecha;
                        var nivel='PROFESIONAL';
                        $.post("grabar.php", { 
                            fecha: fecha,
                            nivel:nivel },
                        function(data){$("#listados").html(data);}); 
             });
             $('.cie').click(function(){
                var fecha=$("#dia_inicio").val()+"-"+$("#mes_inicio").val()+"-"+$("#anio_inicio").val();
                var fecha2=$("#dia_inicio2").val()+"-"+$("#mes_inicio2").val()+"-"+$("#anio_inicio2").val();
                //envio la fecha al post    
                console.log(fecha);
                
                        var fecha=fecha;
                        var nivel='CIE';
                        $.post("grabar.php", { 
                            fecha: fecha,
                            nivel:nivel },
                        function(data){$("#listados").html(data);}); 
             });


             $('.cef').click(function(){
                var fecha=$("#dia_inicio").val()+"-"+$("#mes_inicio").val()+"-"+$("#anio_inicio").val();
                var fecha2=$("#dia_inicio2").val()+"-"+$("#mes_inicio2").val()+"-"+$("#anio_inicio2").val();
                //envio la fecha al post    
                console.log(fecha);
                
                        var fecha=fecha;
                        var nivel='CEF';
                        $.post("grabar.php", { 
                            fecha: fecha,
                            nivel:nivel },
                        function(data){$("#listados").html(data);}); 
             });

             $('.lista').click(function(){

                
                var fecha=$("#dia_inicio").val()+"-"+$("#mes_inicio").val()+"-"+$("#anio_inicio").val();
                var fecha2=$("#dia_inicio2").val()+"-"+$("#mes_inicio2").val()+"-"+$("#anio_inicio2").val();
                
                //envio la fecha al post    
                console.log(fecha);
                
                        var fecha=fecha;
                        var nivel='CEF';
                        $.post("grabar2.php", { 
                            fecha: fecha,
                            fecha2:fecha2 },
                        function(data){$("#listados").html(data);}); 
             });

        $('.inicio').click(function(){

                    if( $("#modalidades").is(":visible") ){
                         $("#modalidades").toggleClass("show");
                    }

                        $(".lista").toggleClass("hide");
                        $(".servicios").toggleClass("show");
                        
                       
                        });

                        $('.modalidades').click(function(){
                            $("#modalidades").toggleClass("show");
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
    }
    
.btn{font-family: Arial; font-size: 14pt; }


fieldset
{
  background-color:#CCC;
  max-width:100px;
  padding:1px;	
}
.legend1
{
  margin-bottom:0px;
  margin-left:16px;
}
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


      


      <div class="col-lg-20 fechaa">
                            <div id="fecha_inicio2">
                                <select name="dia" id="dia_inicio2">
                                    <?php
                                    for ($i=1; $i<=31; $i++) {
                                        if ($i == date('j'))
                                            echo '<option value="'.$i.'" selected>'.$i.'</option>';
                                        else
                                            echo '<option value="'.$i.'">'.$i.'</option>';
                                    }
                                    ?>
                            </select>
                            <select name="mes" id="mes_inicio2">
                                    <?php
                                    for ($i=1; $i<=12; $i++) {
                                        if ($i == date('m'))

                                            echo '<option value="'.$i.'" selected>'.$i.'</option>';
                                        else
                                            echo '<option value="'.$i.'">'.$i.'</option>';
                                    }
                                    ?>
                            </select>
                            <select name="ano" id="anio_inicio2">
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
      

<div class="legend1">¿EXPORTA?</div>
    <fieldset>
        <input type="radio" name="exporta" value="1" id="exporta" > SI
        <input type="radio" name="exporta" value="0" id="exporta" checked="checked" > NO<br>
    </fieldset>
</div>
      <div id="cuerpo">
        <button type="button" class="btn btn-primary inicio">LISTADOS POR NIVEL</button>
        <button type="button" class="btn btn-primary lista">LISTADOS POR FECHA</button>
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
                <button type="button" class="btn btn-secondary cef">ED. FISICA</button>
                <button type="button" class="btn btn-dark especial">ESPECIAL</button>
                <button type="button" class="btn btn-secondary artistica">ARTISTICA</button>
                <button type="button" class="btn btn-danger adultos">ADULTOS</button>


<!--                 <button type="button" class="btn btn-danger EEPA-701">ADULTOS-EEPA-701</button>
                <button type="button" class="btn btn-danger CEA702">SEC-ADULTOS-702</button>
                <button type="button" class="btn btn-danger CEA703">SEC-ADULTOS-703</button>
                <button type="button" class="btn btn-danger CEA704">SEC-ADULTOS-704</button>
                <button type="button" class="btn btn-warning CENS451">SEC-ADULTOS-CENS-451</button>
                <button type="button" class="btn btn-warning CENS452">SEC-ADULTOS-CENS-452</button>
                <button type="button" class="btn btn-warning CENS453">SEC-ADULTOS-CENS-453</button>
                <button type="button" class="btn btn-secondary CEF93">CEF93</button> -->

                
                <button type="button" class="btn btn-info fp">FORMACION-PROFESIONAL</button>
                <button type="button" class="btn btn-danger cie">CIE</button>
                <hr>
         </div>

<div id="listados">


</div>
</div>
    </body>
</html>