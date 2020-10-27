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

            <?php $iid = $user['id_inst'] ?>
            <?php if($idd != -1): ?>
              <br> Welcome Boss
              <?php
                  require("config/conexion.php");
                
                  $records = $db->prepare('SELECT p.nombre 
                                           FROM puertos AS p, instalacion AS i 
                                          WHERE (i.iid=:id_user AND i.pid_puerto=p.pid)');
                  $records->bindParam(':id_user', $iid);
                  $records->execute();
                  $puerto = $records->fetch(PDO::FETCH_ASSOC);
              ?>
              <br> Nombre puerto: <?= $puerto['nombre'] ?>

            <?php endif; ?>
              
            <?php $bid = $user['id_buque'] ?>
            <?php if($bid != -1): ?>
              <br> Welcome Capitan
              <?php
                  require("config/conexion2.php");
                
                  $records = $db->prepare('SELECT nombre, patente FROM buques WHERE bid = :id_user');
                  $records->bindParam(':id_user', $bid);
                  $records->execute();
                  $buque = $records->fetch(PDO::FETCH_ASSOC);
              ?>

              <br> Nombre barco: <?= $buque['nombre']?>
              <br> Patente barco: <?= $buque['patente']?>


            <?php endif; ?>

        <?php else: ?>
            <h1>Please Login or SignUp</h1>

            <a href="users/login.php">Login</a> or
            <a href="users/signup.php">SignUp</a>
        <?php endif; ?>
        <br> <a href="main.php">Navegacion</a>

        <?php //require("mergeusers.php")?>
</body>
</html>
