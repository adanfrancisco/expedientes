<script>
    $("#alta_frm").on( "click", function() {  
alert('si');});
function ingresar_nuevo_docente(){
    var nombre=$('#name').val();

      $.post("alta.php", { nombre: nombre },
    function(data){$("#result").html(data);});
/*     var ddni=0;
    var xclave_nueva=$("#clave_nueva").val();
    var ddni=$("#dddni").val();
    console.log('si'+ddni);
    //$('#clave').text('quiere cambiar clave a: '+ ddni + '-'+clave_nueva);
    
    $.post("buscar/cambia_clave.php", { xclave_nueva: xclave_nueva, ddni: ddni },
    function(data){$("#clave").html(data);});
    });    
    */
    
    console.log('nuevo docente'+nombre);
}
function mostrar(){
    $('#botones').show();
    $('#btn_alta').hide();
}
function mostrar_alta(){
    $('#btn_alta').show();
    $('#botones').hide();
}
$("#alta_profe").on( "click", function() {  
   // alert('si');
   var dni=$("#dni").val();
   var apellido=$("#apellido").val();
   var nombre=$("#nombre").val();
   var direccion=$("#direccion").val();
   var localidad=$("#localidad").val();
   var email=$("#email").val();
   var telefono=$("#telefonofijo").val();
   var celular=$("#telefonomovil").val();


    console.log('alta'+dni+apellido+nombre+direccion+localidad+email+telefono+celular);
/*             $('#clave').toggle("swing");
            $('#reabajo').hide(); */
             });
  /*                       $("#btn_asigna_usuario").on( "click", function() {  
                        console.log('esta cambiando la clave');
                        var ddni=0;
                        var xclave_nueva=$("#clave_nueva").val();
                        var ddni=$("#dddni").val();
                        console.log('si'+ddni);
                        //$('#clave').text('quiere cambiar clave a: '+ ddni + '-'+clave_nueva);
                        
                        $.post("buscar/cambia_clave.php", { xclave_nueva: xclave_nueva, ddni: ddni },
                        function(data){$("#clave").html(data);});
                        });   */
    </script>
