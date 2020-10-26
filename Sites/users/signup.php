<?php
    session_start();
    require("../config/conexion.php");
    $message = '';
    if (!empty($_POST['username']) && !empty($_POST['password'])) {
        $sql = "INSERT INTO users (username, password) VALUES (:username, :password)";
        $stmt = $db->prepare($sql);
        $stmt->bindParam(':username', $_POST['username']);
        $password = password_hash($_POST['password'], PASSWORD_BCRYPT);
        $stmt->bindParam(':password', $password);

        if ($stmt->execute()) {
            $message = 'Successfully created new user';

            $records = $db->prepare('SELECT id_user, username, password FROM users WHERE username = :username');
            $records->bindParam(':username', $_POST['username']);
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
                <input name="username" type="text" placeholder="Enter your username">
                <input name="password" type="password" placeholder="Enter your Password">
                <input type="submit" value="Submit">
            </form>
        </div>
    </body>
</html>