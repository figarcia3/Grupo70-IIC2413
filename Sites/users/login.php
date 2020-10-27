<?php

    session_start();
    require("../config/conexion.php");

    if (!empty($_POST['pasaporte']) && !empty($_POST['password'])) {
        $records = $db->prepare('SELECT id_user, pasaporte, password FROM users WHERE pasaporte = :pasaporte');
        $records->bindParam(':pasaporte', $_POST['pasaporte']);
        $records->execute();
        $results = $records->fetch(PDO::FETCH_ASSOC);
    
        $message = '';
    
        if ($_POST['password'] == $results['password']) {
          $_SESSION['user_id'] = $results['id_user'];
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

        <h1>Login</h1>
        <span>or <a href="signup.php">SignUp</a></span>
        <div>
            <h2> Login Here </h2>
            <form action="login.php" method="POST">
                <input name="pasaporte" type="text" placeholder="Enter your pasaporte">
                <input name="password" type="password" placeholder="Enter your Password">
                <input type="submit" value="Submit">
            </form>
        </div>
    </body>
</html>