<?php include('../templates/header.html');   ?>

<body>

<?php
  #Llama a conexión, crea el objeto PDO y obtiene la variable $db
  require("../config/conexion.php");

	$nombre = $_POST["nombre_naviera"];

 	$query = "SELECT * FROM buques,pertenece_a,navieras WHERE navieras.nombre LIKE '%$nombre%' AND navieras.nid = pertenece_a.nid AND buques.bid = pertenece_a.bid;";
	$result = $db -> prepare($query);
	$result -> execute();
	$buques = $result -> fetchAll();
  ?>

<?php $nombre hola que tal ?>


	<table>
    <tr>
      <th>ID</th>
      <th>Patente</th>
      <th>Nombre</th>
    </tr>
  <?php
	foreach ($buques as $buque) {
  		echo "<tr> <td>$buque[0]</td> <td>$buque[1]</td> <td>$buque[2]</td> </tr>";
	}
  ?>
	</table>

<?php include('../templates/footer.html'); ?>
