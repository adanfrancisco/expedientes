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

		var tipo = "text";clase="";
if(campo=='cuil'){
/* 	$("#tabla table tr td").click(function() {
		var celda = $(this);
		$("#name").val(celda.html());
		$("#busca").show();
		$("#name").focus();
        //alert(celda.html());
      }); */
	}else{
			if(campo == 'email'){
				form = '<form action="javascript: this.preventDefault">' +
				'<input   type="' + tipo + '" class="'+ clase +'" size="4" name="newValue" value="'+
			prevContent+'" /><input type="hidden" name="id" value="'+id+'" />'+
			'<input type="hidden"  name="column" value="'+campo+'" /></form>';

			}else{
				if(campo == 'fech_nac')	{tipo = "date";clase="datex";}
				/* if(campo=='cuil'){tipo="text";clase="cuilt";exit;} */
				if(campo == 'telefono')	{tipo = "text";clase="ttelefono";}
				if(campo == 'celular')	{tipo = "text";clase="ttelefono";}
		

				form = '<form action="javascript: this.preventDefault">' +
						'<input   type="' + tipo + '" class="'+ clase +'" size="4" name="newValue" value="'+
					prevContent+'" style="text-transform:uppercase" onkeyup="javascript:this.value=this.value.toUpperCase()"; /><input type="hidden" name="id" value="'+id+'" />'+
					'<input type="hidden"  name="column" value="'+campo+'" /></form>';
					//alert($(this).closest('td').attr('name'));
					//style="text-transform:uppercase;" 
						//onkeyup="javascript:this.value=this.value.toUpperCase();
					}

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
				if (e.keyCode == 13) {
					changeField(cell, prevContent);
				} else if (e.keyCode == 27) {
					cell.text(prevContent);
					cell.off('click'); 
				}
			});

		}
	}//fin localidad
}//fin if
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