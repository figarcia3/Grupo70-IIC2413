<?php include('../templates/header_consultas.html');   ?>


<body>



<?php
  $puerto1 = $_POST["name_puerto"];  
  $fecha1 = $_POST["myDate1"];
  $fecha2 = $_POST["myDate2"];
  $patente = $_POST["patente"];
 
?>

<!-- Header -->
<div class="topnav">
  <a href="../main.php">VOLVER</a>
</div>
<div class="hero-image">
  <div class="hero-text">
    <a  target="_blank"  class="button two">Permiso puerto <?php echo $puerto1 ?>  </a>
    <p><FONT SIZE=5>  Instalaciones tipo Muelle  </FONT></p> 
    <p><FONT SIZE=5>  <?php echo $fecha1 ?>  <?php echo $fecha2 ?></FONT></p>
    </div>

  </div>
</div>


<!-- Connection -->
<?php
  require("../config/conexion.php");


  $query = "select pid from puerto where nombre LIKE '%$puerto1%';";


  $result = $db -> prepare($query);
	$result -> execute();
  $namepuerto= $result -> fetchAll();
  ?>


    <?php
      // echo $resultados;
      foreach ($namepuerto as $p) {
        $puerto_ = $p[0];
    }
    ?>

<!-- Connection -->
<?php
  require("../config/conexion.php");


  $query = "SELECT * FROM reservar_muelle ('$puerto_', '$fecha1', '$patente');";


  $result = $db -> prepare($query);
	$result -> execute();
  $resultados = $result -> fetchAll();

  ?>

<center>  
    <br></br>
  NUEVO PERMISO  
  <table>
  <tr>
    <th>Per_id</th>
    <th>Fecha_i</th>
    <th>id instalación</th>
  </tr>
    <?php
      // echo $resultados;
      foreach ($resultados as $p) {
        echo "<tr><td>$p[0]</td><td>$p[2]</td><td>$p[3]</td></tr>";
    }
    ?>
</table>
</center>






</body>
</html>