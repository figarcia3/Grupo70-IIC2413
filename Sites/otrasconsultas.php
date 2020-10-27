<?php include('templates/header.html');   ?>


<body>

<!-- Header -->

<!-- Header-->
<div class="topnav">
  <a href="index.php">INICIO</a>
  <a href="main.php">PUERTOS</a>
  <a href="MainNavieras.php">NAVIERAS</a>
</div>

<div class="header">
<br>
	<a  target="_blank"  class="button one">Busqueda de personas</a>
  <p><FONT SIZE=5>Información de itinerario</FONT></p></div>
<br>



<form action= "consultasE3/consulta_personas.php" method="post">
  <p>Ingresar nombre: <input type="text" name="nombre" /></p>
</form>
 

</body>
</html>