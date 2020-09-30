<?php include('../templates/header.html');   ?>

<body>
<?php
  #Llama a conexión, crea el objeto PDO y obtiene la variable $db
  require("../config/conexion.php");

    $nombre_puerto = $_POST["nombre_puerto"];

    $query = "CREATE VIEW buquestalcahuano 
              SELECT buques.bid 
              FROM puertos, itinerarios, buques 
              WHERE LOWER(puertos.nombre_puerto) LIKE LOWER('%$nombre_puerto%') 
              AND itinerarios.pid = puertos.pid 
              AND buques.bid=itinerarios.bid;

              SELECT personas.pid,personas.edad,personas.nombre,personas.Nacionalidad,personas.pasaporte 
              FROM personas, capitan_en, buquestalcahuano AS bt 
              WHERE personas.genero= ’mujer’ 
              AND personas.pid = capitan_en.pid 
              AND capitan_en.bid = bt.bid;";
    
    $result = $db -> prepare($query);
	$result -> execute();
	$personas = $result -> fetchAll();
  ?>

	<table>
    <tr>
      <th>ID</th>
      <th>nombre</th>
      <th>nacionalidad</th>
      <th>pasaporte</th>
      <th>edad</th>
    </tr>
  <?php
	foreach ($personas as $persona) {
  		echo "<tr><td>$persona[0]</td><td>$persona[1]</td><td>$persona[2]</td><td>$persona[3]</td><td>$persona[4]</td></tr>";
	}
  ?>
	</table>

<?php include('../templates/footer.html'); ?>