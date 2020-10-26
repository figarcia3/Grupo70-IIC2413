<?php

    session_start();
    require("../config/conexion.php");

    if (!empty($_POST['username']) && !empty($_POST['password'])) {
        $records = $db->prepare('SELECT id_user, username, password FROM users WHERE username = :username');
        $records->bindParam(':username', $_POST['username']);
        $records->execute();
        $results = $records->fetch(PDO::FETCH_ASSOC);
    
        $message = '';
    
        if (password_verify($_POST['password'], $results['password'])) {
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
                <input name="username" type="text" placeholder="Enter your username">
                <input name="password" type="password" placeholder="Enter your Password">
                <input type="submit" value="Submit">
            </form>
        </div>
    </body>
</html>