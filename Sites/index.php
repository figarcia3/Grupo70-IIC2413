<?php
  session_start();

  require("config/conexion.php");
  
  $user = null;

  if (isset($_SESSION['user_id'])) {
    echo 'hola';
    $records = $db->prepare('SELECT id_user, username, password FROM users WHERE id_user = :id_user');
    $records->bindParam(':id_user', $_SESSION['user_id']);
    $records->execute();
    $results = $records->fetch(PDO::FETCH_ASSOC);

    $user = $results;
  }
?>

<?php include('templates/header.html');   ?>

<body>
        <?php if(!empty($user)): ?>
            <br> Welcome. <?= $user['username']; ?>
            <br>You are Successfully Logged In
            <a href="users/logout.php">
                Logout
            </a>
        <?php else: ?>
            <h1>Please Login or SignUp</h1>

            <a href="users/login.php">Login</a> or
            <a href="users/signup.php">SignUp</a>
        <?php endif; ?>
</body>
</html>
