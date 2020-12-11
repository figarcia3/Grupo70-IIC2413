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

  if (!empty($_GET['desired']) or !empty($_GET['required']) or !empty($_GET['forbidden'])) {
    # Aquí deberían manejar los casos en los que no se ingrese información en alguno de los inputs del form, por simplicidad  
    $desired = explode(",", $_GET['desired']);
    $required = explode(",",$_GET['required']);
    $forbidden =  explode(",", $_GET['forbidden']);
    $userId =  $user['id_user'];

    $data = array(
        'desired' => $desired,
        'required' => $required,
        'forbidden' => $forbidden,
        'userId' => intval($userId)
    );


    $options = array(
        'http' => array(
        'method'  => 'GET',
        'content' => json_encode( $data ),
        'header'=>  "Content-Type: application/json\r\n" .
                    "Accept: application/json\r\n"
        )
    );
    
    $context  = stream_context_create( $options );
    $result = file_get_contents( 'https://proyectobdd-2020.herokuapp.com/text-search', false, $context );
    $response = json_decode($result, true);
  }
?>

<?php include('../templates/header_message.html');   ?>

<body>
<!-- Menu -->
<div class="topnav">
  <a href="../users/info_user.php">PERFIL</a>
  <a href="main.php">PUERTOS</a>
  <a href="../MainNavieras.php">NAVIERAS</a>
  <a href="../otrasconsultas.php">PERSONAS</a>
  <a href="../pdi/pdi_search_map.php">PDI</a>
</div>
<br></br>

<div class="tab">
	  <a href="inbox.php">INBOX</a>
    <a href="sent.php">SENT</a>
  	<a href="new_message.php">NEW MESSAGE</a>
  	<a style = "background-color: #ccc;" href="search.php">SEARCH</a>
 

</div>

<div>
        <form align="center" method="get">
            <input id="desired" placeholder="Búsqueda Simple" type="text" name="desired">
            <input id="required" placeholder="Busqueda Exacta" type="text" name="required">
            <input id="forbidden" placeholder="No buscar" type="text" name="forbidden">
        <input type="submit" value="Buscar">
        </form>
</div>

<div id="chat" class="tabcontent">

<?php 
if(!empty($response)) {
  foreach ($response as $value){ ?>

<div class="container">
  <img src="https://i.pinimg.com/originals/0c/3b/3a/0c3b3adb1a7530892e55ef36d3be6cb8.png" alt="Avatar" style="width:100%;">
  <a> Para: <?php echo $value['receptant'] ?> </a> <a> De: <?php echo $value['sender'] ?> </a>
  <p> <?php echo $value['message'] ?> </p>
  <span class="time-right"> Fecha : <?php echo $value['date']?>  </span>
</div>
<?php } }
?>
</div>

</body>
</html> 
