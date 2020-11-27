<?php
  require 'database.php';

  //Variable global
  $message = '';

  if (!empty($_POST['correo']) && !empty($_POST['password'])) {
    $sql = "INSERT INTO usuario (correo, password) VALUES (:correo, :password)";
    //prepare: ejecuta una consulta SQL
    $reg = $conn->prepare($sql);
    //bindParam: Vincula parametros
    $reg->bindParam(':correo', $_POST['correo']);
    //password_hash: método para cifrar. 
    $password = password_hash($_POST['password'], PASSWORD_BCRYPT);
    $reg->bindParam(':password', $password);

    if ($reg->execute()) {
      $message = 'Usuario creado correctamente';
    } else {
      $message = 'Ha ocurrido un error, intente de nuevo';
    }
  }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro de usuarios</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@100&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
  <?php require 'partials/headerp.php'?>

  <!------------------------------------------------------------->
  
    <h1> Registrate </h1>
    <form action="registro.php" method="post">
      <input name="correo" type="text" placeholder="Enter your email">
        <input name="password" type="password" placeholder="Enter your Password">
        <input type="submit" value="Send">
      </form>

      <?php if(!empty($message)): ?>
        <p> <?= $message ?></p>
      <?php endif; ?>
    
    </body>
    </html>