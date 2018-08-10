<?php
/* CLASE PARA LA CONEXION DE PHP CON ACCES 2003 */
class database {
 # variable para almacenar la conexion
 private $conexion;  
 #Base de datos access 2003
 private  $name = '../edicion/test.mdb';

    /* METODO PARA CONECTAR CON LA BASE DE DATOS*/
 public function conectar()
 {
    # Directorio actual de la base de datos
    $db = getcwd()."\\".$this->name;
    if( is_file($db) )
    {
     # Se forma la cadena de conexi�n
     $dsn = "DRIVER={Microsoft Access Driver (*.mdb)};DBQ=".$db;
    # Se realiza la conexon con Access
    $this->conexion = odbc_connect( $dsn, '', '' );
    if (!$this->conexion)
     exit( "Error: No se pudo completar la conexion ");
    }
    else exit("Error: No existe archivo ".$this->name);
 }

 /* METODO PARA CERRAR LA CONEXION A LA BASE DE DATOS*/ 
 public function desconectar()
 {
  odbc_close( $this->conexion );
 // echo 'Conexion a ['.$this->name.'] : Terminado ';
 }
 public function consulta($q)
    {
        $resultado = odbc_exec( $this->conexion, $q) or die( odbc_errormsg() );
        return $resultado;
    }

    function insert($tabla, $campos, $valores){
        #se forma la instruccion SQL
        $q = 'INSERT INTO '.$tabla.' ('.$campos.') VALUES ('.$valores.')';
        $resultado = $this->consulta($q);
        if($resultado) return true;
        else return false;
    }

    function update($tabla, $campo, $valor){
        #se forma la instruccion SQL
        $q = 'UPDATE '.$tabla.'SET ('.$campo.') VALUES ('.$valor.')';
        $resultado = $this->consulta($q);
        if($resultado) return true;
        else return false;
    }


}//fin clase

?>