<script>

function mensaje(){
    alert('accion');
}
</script>

<script>
function ingresar_nuevo_docente(){
    var existe=1;
    var nombre=$('#name').val();

       $.post("add.php", {existe:existe, nombre: nombre },
    function(data){$("#result").html(data);}); 
    
    console.log('nuevo docente'+nombre);
}


function editar_me(dni){
    $.post("busca2.php", { 
            
            dni:dni },
    function(data){$("#result").html(data);});
}

function editar_docente(){
    $('#botones').hide();
    var existe=2;
    var dni=$('#xdni').val();
    var apellido=$('#xapellido').val();
    var nombre=$('#xnombre').val();
    var domicilio=$('#xdomicilio').val();
    var localidad=$('#xlocalidad').val();
    var email=$('#xemail').val();
    var telefono=$('#xtelefono').val(); 
    var celular=$('#xcelular').val(); 
        $.post("add.php", { 
            existe:existe,
            dni:dni,
            nombre: nombre, 
            apellido:apellido,
            domicilio:domicilio,
            localidad:localidad,
            email:email,
            telefono:telefono,
            celular:celular },
    function(data){$("#result").html(data);});  
    
    console.log('\nEdita docente\n'
    +dni
    +'\n'+apellido
    +'\n'+nombre
    +'\n'+domicilio
    +'\n'+localidad
    +'\n'+email
    +'\n'+telefono
    +'\n'+celular
    );
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
