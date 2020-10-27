<?php

  function randomPassword() {
    $alphabet = "abcdefghijklmnopqrstuwxyzABCDEFGHIJKLMNOPQRSTUWXYZ0123456789";
    $pass = array(); //remember to declare $pass as an array
    $alphaLength = strlen($alphabet) - 1; //put the length -1 in cache
    for ($i = 0; $i < 8; $i++) {
        $n = rand(0, $alphaLength);
        $pass[] = $alphabet[$n];
    }
    return implode($pass); //turn the array into a string
  }

  require("config/conexion2.php");

  $join = $db->prepare('SELECT * 
                        FROM personas AS p, capitan_en AS c 
                        WHERE p.pid = c.pid');
  $join->execute();
  $results = $join->fetchAll(PDO::FETCH_ASSOC);

  // echo $pokemones;
  foreach ($results as $p) {
    $sql = "INSERT INTO users (pasaporte, password, nombre, edad, sexo, nacionalidad, id_buque) 
            VALUES (:pasaporte, :password, :nombre, :edad, :sexo, :nacionalidad, :id_buque)";
    $stmt = $db->prepare($sql);
    $stmt->bindParam(':pasaporte', $p['pasaporte']);
    $stmt->bindParam(':password', randomPassword());
    $stmt->bindParam(':nombre', $p['nombre']);
    $stmt->bindParam(':edad', $p['edad']);
    $stmt->bindParam(':sexo', $p['genero']);
    $stmt->bindParam(':nacionalidad', $p['nacionalidad']);
    $stmt->bindParam(':id_buque', $p['bid']);
  
    $stmt->execute();
  }

  require("config/conexion.php");

  $join = $db->prepare('SELECT * 
                        FROM personal AS p, instalacion AS i 
                        WHERE p.rut = i.rut_jefe');
  $join->execute();
  $results = $join->fetchAll(PDO::FETCH_ASSOC);

  // echo $pokemones;
  $nacionalidad = 'Chilena';
  require("config/conexion2.php");
  foreach ($results as $p) {
    $sql = "INSERT INTO users (pasaporte, password, nombre, edad, sexo, nacionalidad, id_inst) 
            VALUES (:pasaporte, :password, :nombre, :edad, :sexo, :nacionalidad, :id_inst)";
    $stmt = $db->prepare($sql);
    $stmt->bindParam(':pasaporte', $p['rut']);
    $stmt->bindParam(':password', randomPassword());
    $stmt->bindParam(':nombre', $p['nombre']);
    $stmt->bindParam(':edad', $p['edad']);
    $stmt->bindParam(':sexo', $p['sexo']);
    $stmt->bindParam(':nacionalidad', $nacionalidad);
    $stmt->bindParam(':id_inst', $p['iid']);

    $stmt->execute();
  }
?>