<?php

require("../config/conexion.php"); #Llama a conexión, crea el objeto PDO y obtiene la variable $db

$pasaporte = $_POST['pasaporte'];
$password  = $_POST['password'];

$query = "SELECT * FROM users WHERE pasaporte = '$pasaporte';";

$result = $db -> prepare($query);
$result -> execute();

$filas = mysql_num_rows($result);

if ($filas > 0){
    echo"esta registrado";
}else{
    echo"ususario disponilbew";
}

?>