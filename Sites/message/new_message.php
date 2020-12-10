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

  if (!empty($_POST['message']) or !empty($_POST['receptant'])) {
    # Aquí deberían manejar los casos en los que no se ingrese información en alguno de los inputs del form, por simplicidad
    $today = getdate();
    $date = $today['year'] . "-" . $today['mon'] . "-" . $today['mday'];
    
    $message = $_POST['message'];
    $sender  = intval($_POST['sender']);
    $receptant = intval($_POST['receptant']);
    $lat     = $_POST['lat'];
    $long    =  $_POST['long'];

    $data = array(
        'message' => $message,
        'sender' => $sender,
        'receptant' => $receptant,
        'lat' => $lat,
        'long' => $long,
        'date' => $date
    );


    $options = array(
        'http' => array(
        'method'  => 'POST',
        'content' => json_encode( $data ),
        'header'=>  "Content-Type: application/json\r\n" .
                    "Accept: application/json\r\n"
        )
    );
    
    $context  = stream_context_create( $options );
    $result = file_get_contents( 'https://proyectobdd-2020.herokuapp.com/messages', false, $context );
    $response = json_decode($result, true);
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
    <a href="sent.php">SENT</a>
  	<a style = "background-color: #ccc;" href="new_message.php">NEW MESSAGE</a>
  	<a href="search.php">SEARCH</a>
 
</div>
<div>
    <form method="POST">
        <input id="message" placeholder="Message" type="text" name="message">
        <input id="sender" placeholder="Id sender" type="text" name="sender">
        <input id="receptant" placeholder="Id receptant" type="text" name="receptant">
        <input id="lat" placeholder="lat" type="text" name="lat">
        <input id="long" placeholder="long" type="text" name="long">
    <input type="submit" value="Send">
    </form>
</div>
<div>
  <?php
    if (!empty($response)) {
         if ($response['succes'] == 'True'){
           echo "Mensaje enviado con éxito. \n";
           echo "Mensaje Id: ".$response['message_id'];
         }
         else{
          echo "Mensaje no fue enviado.\n";
          echo "Detalle: ".$response['details'];
         }

        }
  ?>
</div>




   
</body>
</html> 
