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


<?php include('../templates/header_message.html');   ?>


<body>
<!-- Menu -->
<div class="topnav">
 <a href="../users/info_user.php">PERFIL</a>
  <a href="../MainNavieras.php">NAVIERAS</a>
  <a href="../otrasconsultas.php">PERSONAS</a>
</div>
<br></br>

<div class="tab">
	  <a href="inbox.php">INBOX</a>
    <a style = "background-color: #ccc;" href="sent.php">SENT</a>
  	<a href="new_message.php">NEW MESSAGE</a>
  	<a href="search.php">SEARCH</a>
 

</div>


<?php
$url = 'https://proyectobdd-2020.herokuapp.com/users/'.$user['id_user'];
$result = file_get_contents($url, false);
$response = json_decode($result, true);
$sent= $response[0]['sent_message'];
?>

<div id="chat" class="tabcontent">
<?php 
if(!empty($sent)) {
  foreach ($sent as $message){ 
    
    ?>
<div class="container darker">
  <img src="https://i.pinimg.com/originals/0c/3b/3a/0c3b3adb1a7530892e55ef36d3be6cb8.png" alt="Avatar" style="width:100%;">
  <p> <?php echo $message['message'] ?> </p>
  <span class="time-right"> Fecha : <?php echo $message['date']?>  </span>
</div>
<?php } }

else{  
  echo "<h2> NO HAY MENSAJES ENVIADOS </h2>";
}?>
</div>



   
</body>
</html> 
