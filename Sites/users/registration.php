<?php

require("../config/conexion.php"); #Llama a conexión, crea el objeto PDO y obtiene la variable $db

$pasaporte = $_POST['pasaporte'];
$password  = $_POST['password'];

$query = "SELECT COUNT(*) FROM users WHERE pasaporte = '$pasaporte';";

$result = $db -> prepare($query);
$result -> execute();

if ($result == 0){
    echo $result "Entro en el 0";
}else{ 
    echo $result;
}

?>