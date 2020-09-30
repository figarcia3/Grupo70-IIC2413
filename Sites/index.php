<?php include('templates/header.html');   ?>

<body>
  <h1 align="center">Biblioteca Maritima </h1>
  <p style="text-align:center;">Aquí podrás encontrar información sobre Navieras, Buques, Marineras y Marineros y más.</p>

  <br>
  
  <h3 align="center">¿Quieres ver todas las Navieras?</h3>
  <form align="center" action="consultas/consulta_mostrar_navieras.php" method="post">
    <br><br>
    <input type="submit" value="Mostrar Navieras">
  </form>

  <br>
  <br>
  <br>
  <br>

  <h3 align="center"> ¿Quieres buscar un Buque por nombre de Naviera?</h3>

  <form align="center" action="consultas/consulta_nombre_naviera.php" method="post">
    Nombre:
    <input type="text" name="nombre_naviera">
    <br/><br/>
    <input type="submit" value="Buscar">
  </form>
  
  <br>
  <br>
  <br>

  <h3 align="center"> ¿Quieres buscar un Buque que haya atracado en una cierta ciudad el 2020?</h3>

  <form align="center" action="consultas/consulta_atraque_2020.php" method="post">
    Nombre:
    <input type="text" name="nombre_puerto">
    <br/><br/>
    Año:
    <input type="text" name="atraque">
    <br/><br/>
    <input type="submit" value="Buscar">
  </form>
  
  <br>
  <br>
  <br>

  <h3 align="center"> ¿Quieres conocer los Pokemones más altos que: ?</h3>

  <form align="center" action="consultas/consulta_altura.php" method="post">
    Altura Mínima:
    <input type="text" name="altura">
    <br/><br/>
    <input type="submit" value="Buscar">
  </form>
  <br>
  <br>
  <br>

</body>
</html>
