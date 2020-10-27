<?php include('../templates/header_consultas.html');   ?>


<body>



<?php
  $puerto = $_POST["radio"];  
?>

<!-- Header -->
<div class="topnav">
  <a href="../main.php">VOLVER</a>
</div>
<div class="hero-image">
  <div class="hero-text">
    <a  target="_blank"  class="button two">Puerto <?php echo $puerto ?>  </a>
    <p><FONT SIZE=5>  Información disponibilidad en puerto  </FONT></p></div>

  </div>
</div>



<?php
  $puerto = $_POST["radio"];
?>



<div class="row">

<form action= "resultados_puertos.php" method="post">

  <div class="column">
    <div class="card">
      <h3>Capacidad en instalaciones</h3>
      Seleccione intervalo de fechas
     <br></br>  <input type="date" id="myDate1" name="myDate1" required = "True">
 <input type="date" id="myDate2" name="myDate2"  required = "True">
 <input type="hidden" name="name_puerto"  id="name_puerto" value="<?php echo $puerto ?>" >
    <br></br>
<button type="submit">Buscar</button>
    </div>
  </div>

  </form>


  <form id = "form" action= "" method="post">

  <div class="column">
    <div class="card">
      <h3> Solicitar permiso</h3>
      <input  value = "muelle" type="radio" value= "muelle"  name="radio" onclick = "FechaMuelle()" > Muelle
        <span class="checkmark"></span>
      <input  value = "muelle" type="radio" value= "muelle"  name="radio" onclick = "FechaAstillero()"> Astillero
        <span class="checkmark"></span>
        <br></br>
        <input type="text" id="patente" name="patente" required = "True" placeholder = "Patente...">
        <br></br>
       <input type="date" id="myDate3" name="myDate1" required = "True">
       <input type="date" id="myDate4" name="myDate2" required = "True" disabled >
       <input type="hidden" name="name_puerto" id="name_puerto" value="<?php echo $puerto ?>" >

       <br></br>
    <button onclick="myFunction()">Reservar</button>

    </div>
    </div>
    </form>

</div>



<script>
function FechaAstillero() {
document.getElementById("myDate4").disabled =false;
document.getElementById("form").action = "resultados3_puertos.php";


}
function FechaMuelle() {
document.getElementById("myDate4").disabled =true;
document.getElementById("form").action = "resultados2_puertos.php";

}
</script>




</body>
</html>