<?php include('../templates/header.html');   ?>

<body>
<?php
  #Llama a conexión, crea el objeto PDO y obtiene la variable $db
  require("../config/conexion.php");

    $nombre_puerto = $_POST["nombre_puerto"];
    $nombre_buque = $_POST["nombre_buque"];

    $query = "CREATE VIEW in_MM SELECT I1.fecha_atraque, I1.fecha_salida FROM puertos AS P, itinerarios AS I1, buques AS B1 WHERE LOWER(P.nombre_puerto) LIKE LOWER('%$nombre_puerto%') AND I1.pid = P.pid AND LOWER(B1.nombre) LIKE LOWER('%$nombre_buque%') AND I1.bid = B1.bid;
              SELECT * FROM puertos AS P, itinerarios AS I2, buques AS B2, in_MM AS MM WHERE LOWER(P.nombre_puerto) LIKE LOWER('%$nombre_puerto%') AND I2.pid = P.pid AND B2.bid = I2.bid AND I2.fecha_atraque>= MM.fecha_atraque AND I2.fecha_atraque<=MM.fecha_salida;";
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