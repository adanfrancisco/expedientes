$(function() {

	//when a td element within tbody is clicked
	$('tbody').on('click','td',function() {
		//call displayform, passing td jQuery element
		displayForm( $(this) );
	});

});

function displayForm( cell ) {

	var col = cell.parent().children().parent().children().index(cell);
	var row = cell.parent().parent().children().index(cell.parent());
	/* console.log(col + ' '+row); */

/* console.log(cell.attr("class")); */
campo=cell.closest('td').attr('name');



if(campo=='localidad'){
	alert('localidad-popup');
	

	var column = cell.attr('class'),//class of td corresponds to database table column
		id = cell.closest('tr').attr('class'),// Clase de ese atributo //id corresponde a primary key
		campo=cell.closest('td').attr('name'),// Levanto el atributo name de la columna (EL NOMBRE)
		cellWidth = cell.css('width'),//Obtengo el ancho de la celda
		prevContent = cell.text(),//Guardo el valor previo
		//form action prevents page refresh when enter pressed.  hidden fields pass primary key and column name


		form = '<form action="javascript: this.preventDefault">'+
					'<input  type="text" size="4" name="newValue" value="'+prevContent+'" />'+
					'<input type="hidden" name="id" value="'+id+'" />'+
					   '<input type="hidden"  name="column" value="'+campo+'" />'+
				'</form>';
			//alert($(this).closest('td').attr('name'));


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





}else{





	var column = cell.attr('class'),//class of td corresponds to database table column
		id = cell.closest('tr').attr('class'),// Clase de ese atributo //id corresponde a primary key
		campo=cell.closest('td').attr('name'),// Levanto el atributo name de la columna (EL NOMBRE)
		cellWidth = cell.css('width'),//Obtengo el ancho de la celda
		prevContent = cell.text(),//Guardo el valor previo
		//form action prevents page refresh when enter pressed.  hidden fields pass primary key and column name


		form = '<form action="javascript: this.preventDefault"><input  type="text" size="4" name="newValue" value="'+
			   prevContent+'" /><input type="hidden" name="id" value="'+id+'" />'+
			   '<input type="hidden"  name="column" value="'+campo+'" /></form>';
			   //alert($(this).closest('td').attr('name'));
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

	//remove keydown listener once action initiated
	//cell.off('keydown');

	var url = 'ajax.php?edit&',//relative path to PHP processing script

		input = cell.find('form').serialize();//serialize form for passing via url

		console.log('input '+ url+input);

		$.getJSON(url+input,  function(data) {
			
	//On success, update cell to new value
		if (data.success){
			cell.html(data.value);
			console.log('fue exitoso');
		}else {
			console.log('algo fallo');
			//On failure, revert to original value and alert
			cell.html(prevContent);
		}
		});


/* //send ajax request
 	$.getJSON(url+input, function(data) {//data argument is used to retrieve response from processing script
console.log('envio ajax');

	//On success, update cell to new value
		if (data.success){
			cell.html(data.value);
			console.log('fue exitoso');
		}else {
			console.log('algo fallo');
			//On failure, revert to original value and alert
			cell.html(prevContent);
		}

	}); */

	//remove click handler to allow tbody handler to make field editable again
	cell.off('click');

}