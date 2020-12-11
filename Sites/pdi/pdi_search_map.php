<?php include('../templates/header_pdi.html');   ?>

<body>




<!-- Menu -->
<div class="topnav">
  <a href="../users/info_user.php">PERFIL</a>
  <a href="main.php">PUERTOS</a>
  <a href="../MainNavieras.php">NAVIERAS</a>
  <a href="../otrasconsultas.php">PERSONAS</a>
  <a href="../message/inbox.php">MENSAJES</a>

</div>
<br></br>
<?php 
if (!empty($_POST['pasaporte'])) {

    $url = 'https://proyectobdd-2020.herokuapp.com/users/'.$_POST['pasaporte'];
    $result = file_get_contents($url, false);
    $response = json_decode($result, true);
    $inbox = $response[0]['inbox_message'];
    $sent = $response[0]['sent_message'];


?>
<h1> USUARIO ID : <?php echo $_POST['pasaporte'] ?> </h1>

<?php } ?>

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



 <!-- Make sure you put this AFTER Leaflet's CSS -->

 <script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"
   integrity="sha512-XQoYMqMTK8LvdxXYG3nZ448hOEQiglfqkJs1NOQV44cWnUrBc8PkAOcXy20w0vlaXaVUearIOBhiXZ5V3ynxwA=="
   crossorigin=""></script>

<div id="mapid" style="height: 600px"></div>

<script src="map.js"></script>



<?php 
if(!empty($inbox)) {
  foreach ($inbox as $message){ 
      ?>
<script> var marker = L.marker([<?php echo $message['lat'] ?>, <?php echo $message['long'] ?>  ]).addTo(map); </script>
<?php } }?>



<?php 
if(!empty($sent)) {
  foreach ($sent as $message){ 
       ?>
<script> var marker = L.marker([<?php echo $message['lat'] ?>, <?php echo $message['long'] ?>  ], {icon: greenIcon}).addTo(map); </script>
<?php } }?>



</body>
</html>