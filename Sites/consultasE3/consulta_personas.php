<?php include('../templates/header_consultas.html');   ?>


<body>

<?php
  $nombre = $_POST["nombre"];  
?>

<!-- Header-->
<div class="topnav">
  <a href="../otrasconsultas.php">VOLVER</a>
</div>
<div class="hero-image">
  <div class="hero-text">
    <a  target="_blank"  class="button two">Búsqueda por persona </a>
    <p><FONT SIZE=5> Itinerario</FONT></p>
    </div>

  </div>
</div>

<!-- Connection -->
<?php
  require("../config/conexion2.php");


  $query = "SELECT * FROM busqueda_personas('%$nombre%');";


$result = $db -> prepare($query);
	$result -> execute();
  $resultados = $result -> fetchAll();
  ?>


<center>  
  <table>
  <tr>
    <th>Nombre</th>
    <th>Nombre_buque</th>
    <th>fecha_atraque</th>
    <th>fecha_salida</th>
    <th>nombre_puerto</th>
  </tr>
    <?php
      // echo $resultados;
      foreach ($resultados as $p) {
        echo "<tr><td>$p[0]</td><td>$p[1]</td><td>$p[2]</td><td>$p[3]</td><td>$p[4]</td></tr>";
    }
    ?>
</table>
</center>



</body>
</html>