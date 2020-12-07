<?php
  session_start();

  require("../config/conexion2.php");
  
  $user = null;

  if (isset($_SESSION['user_id'])) {
    $records = $db->prepare('SELECT id_user, pasaporte, nombre, edad, sexo, nacionalidad, id_buque, id_inst FROM users WHERE id_user = :id_user');
    $records->bindParam(':id_user', $_SESSION['user_id']);
    $records->execute();
    $results = $records->fetch(PDO::FETCH_ASSOC);

    $user = $results;
  }
?>



<?php include('../template/header_users.html');   ?>
<body>

<!-- Menu -->
<div class="topnav">
  <a href="../MainNavieras.php">NAVIERAS</a>
  <a href="../otrasconsultas.php">PERSONAS</a>
  <a href="../message/inbox.php">MENSAJES</a>
</div>


<div class="row">
  <div class="column" style="background: #1abc9c;   color: white; margin: 10px 0px 0px 10%; width: 40%;">
    <h1 style="text-align: center; font-size:50px;"> <?php echo $user['nombre'];  ?> </h1>
    <img align="center" src="https://cdn.iconscout.com/icon/free/png-512/laptop-user-1-1179329.png" width=200px height="auto">
  </div>
  <div class="column" style="background-color: #f1f1f1; width: 40%; margin: 10px 0px 0px 0px;">
  	<h1>INFORMACIÓN</h1>
    <h2>Pasaporte: <span> <?php echo $user['pasaporte'];  ?></span></h2> 
    <h2>Edad: <span> <?php echo $user['edad'];  ?> </span></h2>
    <h2>Sexo: <span> <?php echo $user['sexo'];  ?> </span></h2>
    <h2>Nacionalidad: <span> <?php echo $user['nacionalidad'];  ?> </span></h2>
    <br>
  </div>
</div>




<?php $iid = $user['id_inst']; ?>
            <?php if($iid != -1){ ?>
              <div class="row">
              <div class="column" style="height: 150px; background: #898989;   color: white; margin: 10px 10% 10% 10%; width: 80%;">

              <?php
                  require("../config/conexion.php");
                
                  $records = $db->prepare('SELECT p.nombre 
                                           FROM puertos AS p, instalacion AS i 
                                          WHERE (i.iid=:id_user AND i.pid_puerto=p.pid)');
                  $records->bindParam(':id_user', $iid);
                  $records->execute();
                  $puerto = $records->fetch(PDO::FETCH_ASSOC);
              ?>
              <h1>JEFE</h1>
              <h2>PUERTO: <?php echo $puerto['nombre'];  ?> </h2>
              </div>
              </div>

            <?php } ?>

 <?php $bid = $user['id_buque']; ?>
            <?php if($bid != -1){ ?>
              <?php
                  require("../config/conexion2.php");
                
                  $records = $db->prepare('SELECT nombre, patente FROM buques WHERE bid = :id_user');
                  $records->bindParam(':id_user', $bid);
                  $records->execute();
                  $buque = $records->fetch(PDO::FETCH_ASSOC);
              ?>

              <div class="row">
              <div class="column" style="height: 180px; background: #898989;   color: white; margin: 10px 10% 10% 10%; width: 80%;">
              <h1>CAPITAN</h1>
              <h2>BARCO: <?php echo $buque['nombre']; ?> </h2>
              <h2>PATENTE: <?php echo $buque['patente']; ?> </h2>

              </div>
              </div>


            <?php } ?>
    







<center>
<form id ="form" action= "change_password.php"   class="form-container" method="POST">
    <center>
    <button type="submit" class="btn" style ="width: 40%; "> Cambio Contraseña </button>
    </center>
</form>
<form id ="form" action= "logout.php"   class="form-container" method="POST">
    <center>
    <button type="submit" class="btn" style ="width: 40%; "> Log out </button>
    </center>
</form>
</center>




</body>
</html>
