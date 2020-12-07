<?php
  session_start();

  session_unset();

  session_destroy();

  header('Location: /~grupo121/index.php');
?>