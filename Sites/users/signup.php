<?php
    session_start();
    require("../config/conexion.php");
    $message = '';
    if (!empty($_POST['pasaporte']) && !empty($_POST['password'])) {
        $sql = "INSERT INTO users (pasaporte, password, nombre, edad, sexo, nacionalidad) 
                VALUES (:pasaporte, :password, :nombre, :edad, :sexo, :nacionalidad)";
        $stmt = $db->prepare($sql);
        $stmt->bindParam(':pasaporte', $_POST['pasaporte']);
        $stmt->bindParam(':password', $_POST['password']);
        $stmt->bindParam(':nombre', $_POST['nombre']);
        $stmt->bindParam(':edad', $_POST['edad']);
        $stmt->bindParam(':sexo', $_POST['sexo']);
        $stmt->bindParam(':nacionalidad', $_POST['nacionalidad']);

        if ($stmt->execute()) {
            $message = 'Successfully created new user';

            $records = $db->prepare('SELECT id_user, pasaporte, password FROM users WHERE pasaporte = :pasaporte');
            $records->bindParam(':pasaporte', $_POST['pasaporte']);
            $records->execute();
            $results = $records->fetch(PDO::FETCH_ASSOC);

            $_SESSION['user_id'] = $results['id_user'];
            header('Location: /~grupo70/index.php');
        } else {
            $message = 'Sorry there must have been an issue creating your account';
        }
    }
?>

<?php include('../templates/header.html');   ?>
    <body>
        <?php if(!empty($message)): ?>
            <p> <?= $message ?></p>
        <?php endif; ?>

        <h1>SignUp</h1>
        <span>or <a href="login.php">Login</a></span>
        <div>
            <h2> Sign un </h2>
            <form action="signup.php" method="POST">
                <input name="pasaporte" type="text" placeholder="Enter your pasaporte">
                <input name="password" type="password" placeholder="Enter your Password">
                <input name="nombre" type="text" placeholder="Enter your nombre">
                <input name="edad" type="int">
                <input name="sexo" type="text" placeholder="Enter your sexo">
                <input name="nacionalidad" type="text" placeholder="Enter your nacionalidad">
                <input type="submit" value="Submit">
            </form>
        </div>
    </body>
</html>