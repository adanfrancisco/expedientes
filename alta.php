<html xmlns="http://www.w3.org/1999/xhtml" lang="es" xml:lang="es">
<head>
<title></title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script> 
<style type="text/css">
/* Formatear el formulario a dos columnas */
body {  font: 13px/1.6 Tahoma, sans-serif;  background: #F5F5F5;}
.izquierda {  float: left;  clear: left;}

.derecha {  float: right;  clear: right;}
ul {  list-style: none;  margin: 0;  padding: 0;}
#contenedor {  background: #FFF;  border: 1px solid silver;  margin: 1em auto;  padding: 1em;  width: 768px;}
span.requerido {  font-size: 1.3em;  font-weight: bold;  color: #C00;}
h2 {  font: normal 2em arial, sans-serif;  margin: 0;}
ul li.botones {  border-top: 2px solid #CCC;  clear: both;  float: none;  padding: 1em 0;  margin-top: 1em;
  text-align: right;  width: 100%;}
ul li.botones input {  font-size: 1.3em;}
ul li {  margin: 0.5em 0;  padding: 0.5em;  width: 46%;}
ul li label.titulo {  font-weight: bold;}
ul li div span {  float: left;  padding: 0.3em 0;}
ul li div span.completo {  width: 100%;}
ul li div span.mitad {  width: 50%;}
ul li div span.tercio {  width: 33%;}
ul li div span.dostercios {  width: 66%;}
ul li div span label {  display: block;  font: normal 0.8em arial, sans-serif;  color: #333;}
ul li p.ayuda {  display: none;}
ul li input {  padding: 0.2em;}
input#apellido1, input#apellido2, input#direccion, input#email {  width: 260px;}
input#codigopostal {  width: 80px;}
select#provincia {  width: 90px;}
select#pais {  width: 150px;}
input#telefonofijo, input#telefonomovil {  width: 135px;}
/* Cambiar el color en el :hover y resaltar los campos en el :focus */
ul li:hover {  background-color: #FF9;}
ul li.botones:hover {  background-color: transparent;}
ul li input:focus {  border: 2px solid #E6B700;}
/* Formatear el formulario a una columna */ul li.izquierda, ul li.derecha {  float: none;  width: auto;}
ul li {  overflow: hidden;}
ul li label.titulo {  float: left;  width: 150px;}
ul li div {  margin-left: 160px;}
/* Aspecto final del formulario con los mensajes de ayuda */
h2 {  margin-bottom: 0.3em;}
ul li {  border-top: 1px solid #CCC;  margin: 0;  padding: 1em;}
ul li.botones {  margin: 0;}
ul li label.titulo {  text-align: right;  width: 100px;}
ul li div {  margin-left: 110px;  overflow: hidden;}
ul li {  position: relative;}
ul li:hover p.ayuda {  display: block;  margin: 0.3em;  position: absolute;  top: 0;  right: 0;  width: 150px;}
</style>


</head>

<body>
<div id="contenedor">

<h2>Formulario de alta</h2>

<!-- <form method="post" action="#"> -->
<ul>
<li class="izquierda">
  <label class="titulo" for="nombre">Nombre y apellidos <span class="requerido">*</span></label>
  <div>

   <span class="completo">
      <span class="completo">
      <input id="dni" name="dni" value="" />
      <label for="dni">DNI o CUIL</label>
    </span>
      <input id="apellido" name="apellido" value="';

            echo $_POST['nombre'].'" />
      <label for="apellido">Apellido</label>
    </span>
    <span class="completo">
      <input id="nombre" name="nombre" value="" />
      <label for="nombre">Nombre</label>
    </span>
     </div>
  <p class="ayuda">No te olvides de escribir todo</p>
</li>

<li class="derecha">
  <label class="titulo" for="direccion">Direccion <span class="requerido">*</span></label>

  <div>
    <span class="completo">
      <input id="direccion" name="direccion" value="" />
      <label for="direccion">Calle, numero, piso, puerta</label>
    </span>
// HACER BUCLE DE CARGA
    <span class="tercio">
      <select id="localidad" name="localidad">
        <option value=""></option>
        <option value="provincia1">localidad 1</option>
        <option value="provincia2">localidad 2</option>
        <option value="provincia3">localidad 3</option>
      </select>
      <label for="localidad">Localidad</label>
    </span>

  </div>

  <p class="ayuda">

  </li>

<li class="izquierda">
  <label class="titulo" for="email">Email</label>

  <div>
    <span class="completo">
      <input id="email" name="email" value="" />
    </span>
  </div>

  <p class="ayuda">nombre@dominio.com</p>
</li>

<li class="derecha">
  <label class="titulo" for="telefonofijo">Telefono <span class="requerido">*</span></label>

  <div>
    <span class="mitad">
      <input id="telefonofijo" name="telefonofijo" value="" />
      <label for="telefonofijo">Fijo</label>
    </span>

    <span class="mitad">
      <input id="telefonomovil" name="telefonomovil" value="" />
      <label for="telefonomovil">Movil</label>
    </span>
  </div>

  <p class="ayuda">10 dig sin el cero,si el nro es
  011-15-2233-9988 se escribe 1122339988</p>
</li>

<li class="botones">

  <button class="input-submit-blue" id="alta_profe">Guardar</button>	
</li>

</ul>
<!-- </form> -->

</div>
<?php
			include 'funciones_js.php';?>
</body>
</html>