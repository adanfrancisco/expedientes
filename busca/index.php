<!DOCTYPE html PUBLIC '-//W3C//DTD XHTML 1.0 Strict//EN
    http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd'>
<html xmlns='http://www.w3.org/1999/xhtml' xml:lang='en' lang='en'>
    <head>
        <script type="text/javascript" src="js/jquery.min.js"></script>
        <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>
		<script type="text/javascript" src="js/edit.js"></script>
		<script type="text/javascript" src="js/jquery.mask.min.js"></script>
		<script src="js/examples.js"></script>

	<meta charset="utf-8">
   </head>

   <script>
////BUSQUEDA AJAX

       $("#busqueda").keyup(function()
        {  alert('si');
        var name = $(this).val();
        console.log(name);
        if(name.length >10)
        {  
            alert('si');
        $("#resultadoBusqueda").html('buscando...');
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

});
   </script>
    <body>


<form accept-charset="utf-8" method="POST">
<label>CUIT</label>
<input type="text"
 name="busqueda" id="busqueda"  class="cuilt" value="" placeholder="" maxlength="14" autocomplete="off"  Autofocus />
<!--  <input type="text"
 name="busqueda" id="busqueda"  class="cuilt" value="" placeholder="" maxlength="14" autocomplete="off" onKeyUp="buscar();" 
 style="text-transform:uppercase;" onkeyup="javascript:this.value=this.value.toUpperCase();" Autofocus /> -->
</form>
<div id="resultadoBusqueda"></div>
</body>
    </html>
