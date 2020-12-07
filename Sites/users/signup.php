<?php
    session_start();
    require("../config/conexion2.php");
    $message = '';
    if (!empty($_POST['pasaporte']) && !empty($_POST['password'])) {
        $sql = "INSERT INTO users (pasaporte, password, nombre, edad, sexo, nacionalidad) 
                VALUES (:pasaporte, :password, :nombre, :edad, :sexo, :nacionalidad)";
        $stmt = $db->prepare($sql);
        $stmt->bindParam(':pasaporte', $_POST['pasaporte']);
        $stmt->bindParam(':password', $_POST['password']);
        $stmt->bindParam(':nombre', $_POST['nombre']);
        $stmt->bindParam(':edad', $_POST['edad']);
        $stmt->bindParam(':sexo', $_POST['sexo']);
        $stmt->bindParam(':nacionalidad', $_POST['nacionalidad']);

        if ($stmt->execute()) {

            $records = $db->prepare('SELECT id_user, pasaporte, password FROM users WHERE pasaporte = :pasaporte');
            $records->bindParam(':pasaporte', $_POST['pasaporte']);
            $records->execute();
            $results = $records->fetch(PDO::FETCH_ASSOC);

            $_SESSION['user_id'] = $results['id_user'];
            header('Location: /~grupo70/users/info_user.php');
        } else {
            header('Location: /~grupo70/index.php');   
        }
    }
?>