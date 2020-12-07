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
            header("Location: /~grupo121/users/info_user.php");
        } else {
          $message = 'Sorry, those credentials do not match';
        }
      }

?>

<?php include('../template/header_users.html');   ?>
<body>
<!-- Menu -->
<div class="topnav">
  <a href="info_user.php">PERFIL</a>
  <a href="../MainNavieras.php">NAVIERAS</a>
  <a href="../otrasconsultas.php">PERSONAS</a>
  <a href="../message/inbox.php">MENSAJES</a>

</div>

<center>
<div class="row">
  
  <div class="column" style="background-color: #f1f1f1; width: 50%; margin: 10px 0px 0px 20%;">
  
  
   <form id ="form" action= "change_password.php"   class="form-container" style ="width: 100%; background-color: #f1f1f1;"  method="POST">
    <h1>Cambio contraseña</h1>

            <?php if(!empty($message)): ?>
                    <h2 style="opacity: 0.6;"><p> <?= $message ?></p></h2>
                <?php endif; ?>
            
          <input id = "password" required = "True" style="background-color: white;" placeholder="Contraseña actual..." type="text" name="password" >
          <input id = "new_password" required = "True" style="background-color: white;" placeholder="Contraseña nueva..." type="text" name="new_password" >

    
    <button type="submit" class="btn" style ="width: 40%; align:right;"> Submit </button>
    
  </form>
  	


  </div>
</div>
</center>

</body>
</html>