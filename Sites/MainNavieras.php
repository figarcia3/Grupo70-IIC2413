<?php include('templates/header.html');   ?>


<body>

<!-- Header-->
<div class="topnav">
  <a href="index.php">INICIO</a>
  <a href="main.php">PUERTOS</a>
  <a href="otrasconsultas.php">PERSONAS</a>
</div>

<!-- Header -->
<div class="header">
<br>
	<a  target="_blank"  class="button one">NAVIERAS</a>
  <p><FONT SIZE=5>Listado de flota </FONT></p></div>
<br>

<!-- Connection -->
<?php
  require("config/conexion2.php");

  $query = "SELECT nombre_naviera FROM navieras;";

  $result = $db -> prepare($query);
	$result -> execute();
  $resultados = $result -> fetchAll();
  ?>

<form action= "consultasE3/consulta_navieras.php" method="post">
        <?php foreach ($resultados as $p) { ?>
  
        <br></br>
        <label class="container-list"> <?php echo $p[0] ?>
        <input  value = "<?php echo $p[0]  ?>" type="radio" value= "<?php echo $p[0]  ?>"  name="radio">
        <span class="checkmark"></span>
        </label>

		<?php } ?>
    
    <br></br>
    <br></br>

    <button style=" background-color: #4CAF50;
  color: white;
  padding: 20px 20px;
  border: none;
  cursor: pointer;
  margin-bottom:10px;
  opacity: 0.8;"type="submit" onclick="displayRadioValue()"> Submit </button>
</form>

<div id="result"></div> 
 






<!-- Form-->
<div class="form-popup" id="myForm" method="post">
  <form id ="form" action= "consultasE3/consulta_navieras.php" class="form-container">
	<span onclick="closeForm()" class="closebtn">&times;</span>

    <h1><p id="form_title"></p><h1>
    <h2 ><p id="description"></h2>

    <label for="email"><b><p id="item1"></p></b></label>
    <input id = "input1" type="text" name="input1" >

    <label for="email"><b><p id="item2"></p></b></label>
    <input id = "input2" type="text" name="input2" >

    <button type="submit" class="btn" >Buscar </button>
 
 	
  </form>
</div>











    <script> 
        function displayRadioValue() { 
            var ele = document.getElementsByName('radio'); 
              
            for(i = 0; i < ele.length; i++) { 
                if(ele[i].checked) 
                document.getElementById("result").innerHTML
                        = "Gender: "+ele[i].value; 
            } 
        } 
    </script> 


</body>
</html>