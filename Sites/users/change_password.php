<?php

    session_start();
    require("../config/conexion2.php");

    if (!empty($_POST['password']) && !empty($_POST['new_password'])) {

        $records = $db->prepare('SELECT password 
                                 FROM users 
                                 WHERE id_user = :id_user');

        $records->bindParam(':id_user', $_SESSION['user_id']);
        $records->execute();
        $results = $records->fetch(PDO::FETCH_ASSOC);

        $records = $db->prepare('UPDATE users 
                                 SET password = :new_password  
                                 WHERE id_user = :id_user');

        $records->bindParam(':id_user', $_SESSION['user_id']);
        $records->bindParam(':new_password', $_POST['new_password']);
        $message = '';
    
        if ($_POST['password'] == $results['password']) {
            $records->execute();
            header("Location: /~grupo70/index.php");
        } else {
          $message = 'Sorry, those credentials do not match';
        }
      }

?>

<?php include('../templates/header.html');   ?>
    <body>
        <?php if(!empty($message)): ?>
            <p> <?= $message ?></p>
        <?php endif; ?>

        <h1>Change Password</h1>
        <span><a href="index.php">Go to Profile</a></span>
        <div>
            <h2> Change Password </h2>
            <form action="change_password.php" method="POST">
                <input name="password" type="password" placeholder="Enter your Password">
                <input name="new_password" type="password" placeholder="Enter your New Password">
                <input type="submit" value="Submit">
            </form>
        </div>
    </body>
</html>