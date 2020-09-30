<?php include('templates/header.html');   ?>

<body>
  <h1 align="center">Biblioteca Maritima </h1>
  <p style="text-align:center;">Aquí podrás encontrar información sobre Navieras, Buques, Marineras y Marineros y más.</p>

  <br>
  
  <h3 align="center">¿Quieres ver todas las Navieras?</h3>
  <form align="center" action="consultas/consulta_1.php" method="post">
    <br><br>
    <input type="submit" value="Mostrar Navieras">
  </form>

  <br>
  <br>
  <br>
  <br>

  <h3 align="center"> ¿Quieres buscar un Buque por nombre de Naviera?</h3>

  <form align="center" action="consultas/consulta_2.php" method="post">
    Nombre Naviera:
    <input type="text" name="nombre_naviera">
    <br/><br/>
    <input type="submit" value="Buscar">
  </form>
  
  <br>
  <br>
  <br>

  <h3 align="center"> ¿Quieres buscar un Buque que haya atracado en una ciudad al mismo tiempo que otro?</h3>

  <form align="center" action="consultas/consulta_4.php" method="post">
    Nombre Ciudad:
    <input type="text" name="nombre_puerto">
    <br/><br/>
    Nombre Buque:
    <input type="text" name="nombre_buque">
    <br/><br/>
    <input type="submit" value="Buscar">
  </form>
  
  <br>
  <br>
  <br>

  <h3 align="center"> ¿Quieres buscar un Buque que haya atracado en algun año en cierta ciudad?</h3>

<form align="center" action="consultas/consulta_3.php" method="post">
  Nombre Ciudad:
  <input type="text" name="nombre_puerto">
  <br/><br/>
  Año atraque:
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
