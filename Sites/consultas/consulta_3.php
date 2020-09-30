<?php include('../templates/header.html');   ?>

<body>
<?php
  #Llama a conexión, crea el objeto PDO y obtiene la variable $db
  require("../config/conexion.php");

  $nombre = $_POST["nombre_puerto"];
  $year = $_POST["atraque"];

 	$query = "SELECT * FROM buques,itinerarios,puertos WHERE LOWER(puertos.nombre_puerto) LIKE LOWER('%$nombre%') AND itinerarios.pid=puertos.pid AND EXTRACT(YEAR FROM fecha_atraque) = $year AND itinerarios.bid=buques.bid;";
   $result = $db -> prepare($query);
	$result -> execute();
	$buques = $result -> fetchAll();
  ?>

	<table>
    <tr>
      <th>ID</th>
      <th>Nombre</th>
      <th>Patente</th>
      <th>Origen</th>
    </tr>
  <?php
	foreach ($buques as $buque) {
  		echo "<tr><td>$buque[0]</td><td>$buque[1]</td><td>$buque[2]</td><td>$buque[3]</td></tr>";
	}
  ?>
	</table>

<?php include('../templates/footer.html'); ?>
