<?php

    session_start();
    require("../config/conexion2.php");

    if (!empty($_POST['pasaporte']) && !empty($_POST['password'])) {
        $records = $db->prepare('SELECT id_user, pasaporte, password FROM users WHERE pasaporte = :pasaporte');
        $records->bindParam(':pasaporte', $_POST['pasaporte']);
        $records->execute();
        $results = $records->fetch(PDO::FETCH_ASSOC);
    
        $message = '';
    
        if ($_POST['password'] == $results['password']) {
          $_SESSION['user_id'] = $results['id_user'];
          header("Location: /~grupo121/users/info_user.php");
        } else {
            header("Location: /~grupo121/index2.php");
        }
      }

?>
