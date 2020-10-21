<?php

require("../config/conexion.php"); #Llama a conexión, crea el objeto PDO y obtiene la variable $db

$pasaporte = $_POST['pasaporte'];
$password  = $_POST['password'];

$query = "SELECT * FROM users WHERE pasaporte = '$pasaporte';";

$result = $db -> prepare($query);
$result -> execute();

$num = pg_num_rows($result);

if ($num == 0){
    echo"esta registrado is '$num'";
}else{ 
    echo"ususario disponilbew y '$num'";
}

?>