<?php
  session_start();

  require("config/conexion2.php");
  
  $user = null;

  if (isset($_SESSION['user_id'])) {
    $records = $db->prepare('SELECT id_user, pasaporte, nombre, edad, sexo, nacionalidad, id_buque, id_inst FROM users WHERE id_user = :id_user');
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

            <?php if($user[':id_inst'] != -1): ?>
              <br> Welcome Boss
              <?php
                  require("config/conexion.php");
                
                  $records = $db->prepare('SELECT p.nombre 
                                           FROM puertos AS p, instalacion AS i 
                                          WHERE i.iid = :id_user AND i.pid_puerto=p.pid');
                  $records->bindParam(':id_user', $user['id_inst']);
                  $records->execute();
                  $puerto = $records->fetch(PDO::FETCH_ASSOC);
              ?>
              <br> Nombre puerto: <?php echo $puerto ?>

            <?php endif; ?>

            <?php if($user[':id_buque'] != -1): ?>
              <br> Welcome Capitan
              <?php
                  require("config/conexion2.php");
                
                  $records = $db->prepare('SELECT nombre, patente FROM buques WHERE bid = :id_user');
                  $records->bindParam(':id_user', $user['id_buque']);
                  $records->execute();
                  $buque = $records->fetch(PDO::FETCH_ASSOC);
              ?>

            <?php endif; ?>

        <?php else: ?>
            <h1>Please Login or SignUp</h1>

            <a href="users/login.php">Login</a> or
            <a href="users/signup.php">SignUp</a>
        <?php endif; ?>
        <br> <a href="main.php">Informacion</a>

        <?php //require("mergeusers.php")?>
</body>
</html>
