var localidades = {};

$(function() {

	//when a td element within tbody is clicked
	$('tbody').on('click','td',function() {
		//call displayform, passing td jQuery element
		displayForm( $(this) );
	});
	
	$(document).ready(function (){
		$.getJSON("localidades.php", function(data){
			localidades = data;
		});
	});
});

function displayForm( cell ) {

	var col = cell.parent().children().parent().children().index(cell);
	var row = cell.parent().parent().children().index(cell.parent());
	campo=cell.closest('td').attr('name');
	
	if(campo=='localidad'){
		var idactual = cell.data('id');
		
		var column = cell.attr('class'),//class of td corresponds to database table column
			id = cell.closest('tr').attr('class'),// Clase de ese atributo //id corresponde a primary key
			campo=cell.closest('td').attr('name'),// Levanto el atributo name de la columna (EL NOMBRE)
			cellWidth = cell.css('width'),//Obtengo el ancho de la celda
			prevContent = cell.text(),//Guardo el valor previo
			//form action prevents page refresh when enter pressed.  hidden fields pass primary key and column name


		form = '<form action="javascript: this.preventDefault">'+
			crearSelect("newValue", idactual) +
			'<input type="hidden" name="id" value="'+id+'" />'+
			'<input type="hidden"  name="column" value="'+campo+'" />'+
			'</form>';

	//insert form into td and change focus to input field, set width
	cell.html(form).find('input[type=text]')
		.focus()
		.css('width',cellWidth);

	//disable listener on individual cell once clicked
	cell.on('click', function(){return false});

	//on keypress within td
	cell.on('keydown',function(e) {
		if (e.keyCode == 13) {//13 == enter
			//console.log('presiono enter!!');

			changeField(cell, prevContent);//update field
		} else if (e.keyCode == 27) {//27 == escape
			//console.log('Cancelo!!');

			cell.text(prevContent);//revert to original value
			cell.off('click'); //reactivate editing
		}
	});
	
	var select = cell.find("select").first();
	select.on("blur", function(event){
		var idNuevo = $(this).val();
		var idAnterior = $(this).closest('td').data("id");
		if(idAnterior != idNuevo){
			changeField(cell, idAnterior);
		}
		else{
			cell.html(getLocalidad(idAnterior));
		}
	});
}else{
	var column = cell.attr('class'),//class of td corresponds to database table column
		id = cell.closest('tr').attr('class'),// Clase de ese atributo //id corresponde a primary key
		campo=cell.closest('td').attr('name'),// Levanto el atributo name de la columna (EL NOMBRE)
		cellWidth = cell.css('width'),//Obtengo el ancho de la celda
		prevContent = cell.text();//Guardo el valor previo
		//form action prevents page refresh when enter pressed.  hidden fields pass primary key and column name

		var tipo = "text";clase="";kiup='';
			


		/* if(campo == 'apellido')	{tipo = "text";kiup="javascript:this.value=this.value.toUpperCase()"}
		if(campo == 'nombre')	{tipo = "text";kiup="javascript:this.value=this.value.toUpperCase()"} */
		if(campo == 'email')	{tipo = "text";clase="ttelefono";kiup="javascript:this.value=this.value.toLowerCase()"}
		if(campo == 'fech_nac')	{tipo = "text";kiup = "javascript:this.value=formateafecha(this.value)"}
		//if(campo == 'cuil')	{tipo = "text";clase="";}
		if(campo == 'telefono')	{tipo = "text";clase="ttelefono";kiup="javascript:this.value=this.value.toUpperCase()"}
		if(campo == 'celular')	{tipo = "text";clase="ttelefono";kiup="javascript:this.value=this.value.toUpperCase()"}
		

		form = '<form action="javascript: this.preventDefault">' +
				'<input   type="' + tipo + '" class="'+ clase +'" size="4" name="newValue" value="'+
			   prevContent+'" style="text-transform:uppercase" onkeyup="'+ kiup+'"; /><input type="hidden" name="id" value="'+id+'" />'+
			   '<input type="hidden"  name="column" value="'+campo+'" /></form>';

			
//MUESTRO LOS VALORES PARA SABER CON QUE TRABAJO
console.log( 
	'Fila=' + row +' columna:'+col+  
	' \nID='+id +' VALOR= '+column + '  CAMPO:'+campo+'\nAncho:'+ cellWidth+
	'\nValorPrevio='+prevContent
);			   


	//insert form into td and change focus to input field, set width
	cell.html(form).find('input[type=text]')
		.focus()
		.css('width',cellWidth);

	//disable listener on individual cell once clicked
	cell.on('click', function(){return false});

	//on keypress within td
	cell.on('keydown',function(e) {
		if (e.keyCode == 13) {//13 == enter
			//console.log('presiono enter!!');

			changeField(cell, prevContent);//update field
		} else if (e.keyCode == 27) {//27 == escape
			//console.log('Cancelo!!');

			cell.text(prevContent);//revert to original value
			cell.off('click'); //reactivate editing
		}
	});

}}

function changeField( cell, prevContent ) {
	var campo=cell.closest('td').attr('name');
	var url = 'ajax.php?edit&',//relative path to PHP processing script

		input = cell.find('form').serialize();//serialize form for passing via url
		$.getJSON(url+input,  function(data) {
			
	//On success, update cell to new value
		if (data.success){
			if(campo == 'localidad'){
				cell.data('id', data.value);
				cell.html(getLocalidad(data.value));
			}
			else{
				cell.html(data.value);
			}
			console.log('fue exitoso');
		}else {
			console.log('algo fallo');
			//On failure, revert to original value and alert
			cell.html(prevContent);
		}
	});
	//remove click handler to allow tbody handler to make field editable again
	cell.off('click');

}

function crearSelect(nombre, id){
	var select = '<select name="' + nombre + '">{0}</select>';
	var options = "";
	
	for(var i = 0; i< localidades.length; i++){
		var selected = "";
		var registro = localidades[i];
		if(registro.idLocalidad == id)
			selected = "selected"; 
		options = options + '<option value="' + registro.idLocalidad + '" ' + selected + '>' +
			registro.localidad_nombre +
			'</option>'; 
	}
	
	return select.replace("{0}", options);
}

function getLocalidad(id){
	var localidad = "";
	for(var i = 0; i< localidades.length; i++){
		var registro = localidades[i];
		if(registro.idLocalidad == id){
			localidad = registro.localidad_nombre;
			break;
		}
	}
	
	return localidad;
	
}




function IsNumeric(valor) 
{
    var log=valor.length; var sw="S"; 
    for (x=0; x<log; x++) 
        { 
            v1=valor.substr(x,1); 
            v2 = parseInt(v1); 
            //Compruebo si es un valor numÃ©rico 
            if (isNaN(v2)) { sw= "N";} 
        }
    if (sw=="S") {return true;} else {return false; } 
}

var primerslap=false; 
var segundoslap=false; 
function calcLong(txt, dst, formul, maximo)

      {
      var largo
      largo = formul[txt].value.length
      if (largo > maximo)
      formul[txt].value = formul[txt].value.substring(0,maximo)
      formul[dst].value = formul[txt].value.length
      }

function formateafecha(fecha) 
       { 
           var long = fecha.length; 
           var dia; 
           var mes; 
           var ano; 
           if ((long>=2) && (primerslap==false)) 
           {
               dia=fecha.substr(0,2); 
               if ((IsNumeric(dia)==true) && (dia<=31) && (dia!="00")) 
               { 
                   fecha=fecha.substr(0,2)+"/"+fecha.substr(3,7); primerslap=true; 
               } 
               else 
               { fecha=""; primerslap=false;
                } 
           }else{ 
               dia=fecha.substr(0,1); 
               if (IsNumeric(dia)==false) 
               {
                   fecha="";} 
               if ((long<=2) && (primerslap=true)) 
               {
                   fecha=fecha.substr(0,1); primerslap=false; 
               } 
            } 
           if ((long>=5) && (segundoslap==false)) 
           { mes=fecha.substr(3,2); 
            if ((IsNumeric(mes)==true) &&(mes<=12) && (mes!="00")) { fecha=fecha.substr(0,5)+"/"+fecha.substr(6,4); segundoslap=true; } 
            else { fecha=fecha.substr(0,3);; segundoslap=false;} 
           } 
           else { if ((long<=5) && (segundoslap=true)) { fecha=fecha.substr(0,4); segundoslap=false; } } 
           if (long>=7) 
           { ano=fecha.substr(6,4); 
            if (IsNumeric(ano)==false) { fecha=fecha.substr(0,6); } 
            else { if (long==10){ if ((ano==0) || (ano<1900) || (ano>2100)) { fecha=fecha.substr(0,6); } } } 
           } 
           if (long>=10) 
           { 
               fecha=fecha.substr(0,10); 
               dia=fecha.substr(0,2); 
               mes=fecha.substr(3,2); 
               ano=fecha.substr(6,4); 
               // AÃ±o no viciesto y es febrero y el dia es mayor a 28 
               if ( (ano%4 != 0) && (mes ==02) && (dia > 28) ) { fecha=fecha.substr(0,2)+"/"; } 
           } 
return (fecha); 
}