<?php include('../templates/header_consultas.html');   ?>


<body>

<?php
  $puerto = $_POST["radio"];  
?>

<!-- Header-->
<div class="topnav">
  <a href="../MainNavieras.php">VOLVER</a>
</div>
<div class="hero-image">
  <div class="hero-text">
    <a  target="_blank"  class="button two">Naviera <?php echo $puerto ?> </a>
    <p><FONT SIZE=5> Listado de buques</FONT></p>
    </div>

  </div>
</div>

<!-- Connection -->
<?php
  require("../config/conexion2.php");


  $query = "SELECT * FROM consulta_navieras('$puerto');";


$result = $db -> prepare($query);
	$result -> execute();
  $resultados = $result -> fetchAll();
  ?>


<center>  
  <table>
  <tr>
    <th>Patente</th>
    <th>Nombre</th>
    <th>Tipo</th>
  </tr>
    <?php
      // echo $resultados;
      foreach ($resultados as $p) {
        echo "<tr><td>$p[0]</td><td>$p[1]</td><td>$p[2]</td></tr>";
    }
    ?>
</table>
</center>




</body>
</html>