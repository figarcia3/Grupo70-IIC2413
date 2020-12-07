<?php
  session_start();

  session_unset();

  session_destroy();

  header('Location: /~grupo70/index.php');
?>