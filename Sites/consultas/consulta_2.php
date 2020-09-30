<?php include('../templates/header.html');   ?>

<body>

<?php
  #Llama a conexión, crea el objeto PDO y obtiene la variable $db
  require("../config/conexion.php");

	$nombre = $_POST["nombre_naviera"];

 	$query = "SELECT * FROM buques,pertenece_a,navieras 
            WHERE LOWER(navieras.nombre_naviera) LIKE LOWER('%$nombre%') 
            AND navieras.nid = pertenece_a.nid 
            AND buques.bid = pertenece_a.bid;";
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
  		echo "<tr> <td>$buque[0]</td> <td>$buque[1]</td> <td>$buque[2]</td> <td>$buque[3]</td></tr>";
	}
  ?>
	</table>

<?php include('../templates/footer.html'); ?>
