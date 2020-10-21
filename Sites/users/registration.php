<?php

require("../config/conexion.php"); #Llama a conexión, crea el objeto PDO y obtiene la variable $db

$pasaporte = $_POST['pasaporte'];
$password  = $_POST['password'];
$nombre = $_POST['nombre'];
$nacionalidad  = $_POST['nacionalidad'];
$sexo = $_POST['sexo'];
$edad  = $_POST['edad'];

$query = "SELECT * FROM users WHERE pasaporte = '$pasaporte';";

$result = $db -> prepare($query);
$result -> execute();

$num = $result -> rowCount();

if ($num == 0){
    echo "Hola q tal";
    #$query_max  = "SELECT MAX(user_id) FROM users;";
    #$result_max = $db -> prepare($query_max);
    #$result_max -> execute();
    #$result_max = $result_maxult -> fetchAll();

    #$reg = "INSERT INTO users ()"
}else{ 
    echo "El pasaporte ya fue registrado";
}

?>