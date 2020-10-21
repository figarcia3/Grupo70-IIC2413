<?php

require("../config/conexion.php"); #Llama a conexión, crea el objeto PDO y obtiene la variable $db

$pasaporte = $_POST['pasaporte'];
$password  = $_POST['password'];

$query = "SELECT * FROM users WHERE pasaporte = '$pasaporte';";

$result = $db -> prepare($query);
$result -> execute();

$num = pg_num_rows($result);

if ($num == 0){
    echo "Entro en el 0 " .$num.;
}else{ 
    echo "No entro";
}

?>