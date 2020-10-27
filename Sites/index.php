<?php
  session_start();

  require("config/conexion2.php");
  
  $user = null;

  if (isset($_SESSION['user_id'])) {
    $records = $db->prepare('SELECT id_user, pasaporte, nombre, edad, sexo, nacionalidad FROM users WHERE id_user = :id_user');
    $records->bindParam(':id_user', $_SESSION['user_id']);
    $records->execute();
    $results = $records->fetch(PDO::FETCH_ASSOC);

    $user = $results;
  }
?>

<?php include('templates/header.html');   ?>

<body>
        <?php if(!empty($user)): ?>
            <br> Welcome. <?= $user['nombre']; ?> You are Successfully Logged In
            <br> Pasaporte. <?= $user['pasaporte']; ?>
            <br> Edad. <?= $user['edad']; ?>
            <br> Sexo. <?= $user['sexo']; ?>
            <br> Nacionalidad. <?= $user['nacionalidad']; ?>
            <a href="users/logout.php">
                Logout
            </a>
            <a href="users/change_password.php">
                Change Password
            </a>
        <?php else: ?>
            <h1>Please Login or SignUp</h1>

            <a href="users/login.php">Login</a> or
            <a href="users/signup.php">SignUp</a>
        <?php endif; ?>
        <a href="main.php">Informacion</a>

</body>
</html>
