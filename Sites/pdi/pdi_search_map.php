<?php include('../templates/header_pdi.html');   ?>

<body>




<!-- Menu -->
<div class="topnav">
  <a href="../users/info_user.php">PERFIL</a>
  <a href="../main.php">PUERTOS</a>
  <a href="../MainNavieras.php">NAVIERAS</a>
  <a href="../otrasconsultas.php">PERSONAS</a>
  <a href="../message/inbox.php">MENSAJES</a>

</div>
<br></br>
<h1>  <?php echo $_POST['Date1'] ?> /  <?php echo $_POST['Date2'] ?></h1>
<?php 
$fecha1 = $_POST['Date1'];
$fecha2 = $_POST['Date2'];

if (!empty($_POST['pasaporte'])) {
    $url = 'https://proyectobdd-2020.herokuapp.com/users/'.$_POST['pasaporte'];
    $result = file_get_contents($url, false);
    $response = json_decode($result, true);
    $inbox = $response[0]['inbox_message'];
    $sent = $response[0]['sent_message'];

?>
<h1> USUARIO ID : <?php echo $_POST['pasaporte'] ?> </h1>

<?php } ?>



<?php 
if (!empty($_POST['desired']) or !empty($_POST['required']) or !empty($_POST['forbidden'])) {
  # Aquí deberían manejar los casos en los que no se ingrese información en alguno de los inputs del form, por simplicidad  
  $desired = explode(",", $_POST['desired']);
  $required = explode(",",$_POST['required']);
  $forbidden =  explode(",", $_POST['forbidden']);
  $userId =  $_POST['pasaporte'];

  $data = array(
      'desired' => $desired,
      'required' => $required,
      'forbidden' => $forbidden,
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
  $response_text = json_decode($result, true);

}
?>




<form id ="form" action= "pdi_search_map.php" class="form-container" method="POST">

    <input id = "pasaporte" placeholder="ID..." type="text" name="pasaporte" >
    <input type="date" id="Date1" name="Date1"  required = "True">
    <input type="date" id="Date2" name="Date2"  required = "True">
    <br></br>
    <input id="desired" placeholder="Búsqueda Simple" type="text" name="desired">
    <input id="required" placeholder="Busqueda Exacta" type="text" name="required">
    <input id="forbidden" placeholder="No buscar" type="text" name="forbidden">

    <button type="submit" class="btn" > BUSCAR </button>
 
 	
  </form>



 <script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"
   integrity="sha512-XQoYMqMTK8LvdxXYG3nZ448hOEQiglfqkJs1NOQV44cWnUrBc8PkAOcXy20w0vlaXaVUearIOBhiXZ5V3ynxwA=="
   crossorigin=""></script>

<div id="mapid" style="height: 600px"></div>

<script src="map.js"></script>


 <!-- MARCAS EN EL MAPA -->
 <!-- CON ID -->
<?php 
if(!empty($inbox)) {

  if (empty($_POST['desired']) and empty($_POST['required']) and empty($_POST['forbidden'])) {
  foreach ($inbox as $message){ 
    if ($message['date'] >= $fecha1 && $message['date'] <= $fecha2){ ?>
<script> var marker =  L.marker([<?php echo $message['lat'] ?>, <?php echo $message['long'] ?>  ]).addTo(map);
marker.bindPopup("Message: <?php echo $message['message'] ?> <br></br> Date: <?php echo $message['date'] ?> <br></br> From: <?php echo $message['sender'] ?> To: <?php echo $message['receptant'] ?> ").openPopup();
 </script>
<?php }} }

elseif (!empty($response_text)) {
  foreach ($response_text as $message){ 
    if ($message['date'] >= $fecha1 && $message['date'] <= $fecha2  && $message['receptant'] == strval($_POST['pasaporte'])){ ?>
<script> var marker =  L.marker([<?php echo $message['lat'] ?>, <?php echo $message['long'] ?>  ]).addTo(map);
marker.bindPopup("Message: <?php echo $message['message'] ?> <br></br> Date: <?php echo $message['date'] ?> <br></br> From: <?php echo $message['sender'] ?> To: <?php echo $message['receptant'] ?> ").openPopup();
 </script>

<?php }}}}  ?>

<?php 
if(!empty($sent)) {
  if (empty($_POST['desired']) and empty($_POST['required']) and empty($_POST['forbidden'])) {
  foreach ($sent as $message){ 
    if ($message['date'] >= $fecha1 && $message['date'] <= $fecha2){ ?>
<script> var marker2 = L.marker([<?php echo $message['lat'] ?>, <?php echo $message['long'] ?>  ], {icon: greenIcon}).addTo(map);
marker2.bindPopup("Message: <?php echo $message['message'] ?> <br></br> Date: <?php echo $message['date'] ?> <br></br> From: <?php echo $message['sender'] ?> To: <?php echo $message['receptant'] ?>").openPopup();
</script>

<?php }} }
elseif (!empty($response_text)) {
  foreach ($response_text as $message){ 
    if ($message['date'] >= $fecha1 && $message['date'] <= $fecha2  && $message['sender'] == strval($_POST['pasaporte'])){ ?>
<script> var marker =  L.marker([<?php echo $message['lat'] ?>, <?php echo $message['long'] ?>  ], {icon: greenIcon}).addTo(map);
marker.bindPopup("Message: <?php echo $message['message'] ?> <br></br> Date: <?php echo $message['date'] ?> <br></br> From: <?php echo $message['sender'] ?> To: <?php echo $message['receptant'] ?> ").openPopup();
 </script>
<?php }}} }?>


 <!-- SIN ID -->
 <?php 
if(empty($sent) && empty($inbox) ) {
  $url = 'https://proyectobdd-2020.herokuapp.com/messages';
  $result = file_get_contents($url, false);
  $response_total = json_decode($result, true);

  if (empty($_POST['desired']) and empty($_POST['required']) and empty($_POST['forbidden'])) {
    foreach ($response_total as $message){
      if ($message['date'] >= $fecha1 && $message['date'] <= $fecha2){ ?>
        <script> var marker2 = L.marker([<?php echo $message['lat'] ?>, <?php echo $message['long'] ?>  ], {icon: redIcon}).addTo(map);
        marker2.bindPopup("Message: <?php echo $message['message'] ?> <br></br> Date: <?php echo $message['date'] ?> <br></br> From: <?php echo $message['sender'] ?> To: <?php echo $message['receptant'] ?>").openPopup();
        </script>



  <?php }}}

elseif (!empty($response_text)) {
  foreach ($response_text as $message){ 
    if ($message['date'] >= $fecha1 && $message['date'] <= $fecha2  ){ ?>
<script> var marker =  L.marker([<?php echo $message['lat'] ?>, <?php echo $message['long'] ?>  ], {icon: redIcon}).addTo(map);
marker.bindPopup("Message: <?php echo $message['message'] ?> <br></br> Date: <?php echo $message['date'] ?> <br></br> From: <?php echo $message['sender'] ?> To: <?php echo $message['receptant'] ?> ").openPopup();
 </script>
<?php }}} }?>



</body>
</html>