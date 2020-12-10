<?php include('templates/header_users.html');   ?>


<body>
<!-- Menu -->
<div class="topnav">
  <a href="index.php">INICIO</a>
  <a href="MainNavieras.php">NAVIERAS</a>
  <a href="otrasconsultas.php">PERSONAS</a>
  <a href="pdi/pdi_search_map.php">PDI</a>
</div>

<!-- Header -->
<div class="header">
<br>
	<a  target="_blank"  class="button one">PUERTOS Y NAVIERAS </a>
</div>
<br>



<!-- First row -->
<div class="row">

  <!-- First img -->
  <div class="column" style="width:50%;">
  <div class="card">
  <h1> LOGIN <h1>
     <form id ="form" action= "users/login.php" class="form-container" method="POST">

    <input id = "pasaporte" required = "True" placeholder="Pasaporte..." type="text" name="pasaporte" >
      <input id = "password" required = "True" placeholder="Contraseña..." type="text" 	name="password" >

    <button type="submit" class="btn" > Ingresar </button>
 
 	
  </form>
	</div>
  </div>
  
  <!-- Second img -->
  <div class="column" style="width:50%;">
  <div class="card">
  <h1> SIGN UP <h1>
 <form id ="form" action= "users/signup.php" class="form-container" method="POST">

    <input id = "pasaporte" required = "True" placeholder="Pasaporte..." type="text" name="pasaporte" >
      <input id = "password" required = "True" placeholder="Contraseña..." type="text" 	name="password" >
      <input id = "nombre" required = "True" placeholder="Nombre..." type="text" name="nombre" >
      <input id = "edad" required = "True" placeholder="Edad..." type="text" name="edad" >
      <input id = "sexo" required = "True" placeholder="Sexo..." type="text" name="sexo" >
      <input id = "nacionalidad" required = "True" placeholder="Nacionalidad..." type="text" name="nacionalidad" >
      
    <button type="submit" class="btn" > Registrarse </button>
 
 	
  </form>
    </div>
    </div>

  </div>

  </body>
</html>