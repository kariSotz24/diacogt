<?php
  session_start();
  require 'database.php';
  if (isset($_SESSION['id_usuario'])) {
    $records = $conn->prepare('SELECT id_usuario, correo, password FROM usuario WHERE id_usuario = :id_usuario');
    $records->bindParam(':id_usuario', $_SESSION['id_usuario']);
    $records->execute();
    $results = $records->fetch(PDO::FETCH_ASSOC);
    $user = null;
    if (count($results) > 0) {
      $user = $results;
    }
  }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DIACOGT</title>
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@100&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
  <!-- Ingreso al usuario privilegiado -->
  <?php if(!empty($user)): ?>
  <?php require 'iniciop.php'?>
  <?php else: ?>
  <!-- Ingreso de usuario no logueado -->
  <?php require 'partials/header.php'?>
    <img src="img/vision.png">   
  <!---->
  <?php endif; ?>
</body>
</html>






