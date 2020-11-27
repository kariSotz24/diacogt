<?php
    //funcion: para inicializar las sesiones.
    session_start();
    if (isset($_SESSION['id_usuario'])) {
        header('Location: /diacogt');
    }
    require 'database.php';
    //Comprobación de usuarios 
    if (!empty($_POST['correo']) && !empty($_POST['password'])) {
    //prepare: Ejecuta una consulta SQL
    $registro = $conn->prepare('SELECT id_usuario, correo, password FROM usuario WHERE correo = :correo');
    $registro->bindParam(':correo', $_POST['correo']);
    $registro->execute();
    $results = $registro->fetch(PDO::FETCH_ASSOC);
    $message = '';
    //count: metodo para contar los resultados.
    if (count($results) > 0 && password_verify($_POST['password'], $results['password'])) {
      $_SESSION['id_usuario'] = $results['id_usuario'];
      header("Location: /diacogt");
    } else {
      $message = 'Usuario incorrecto, intentelo de  nuevo';
    }
  }
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Login</title>
        <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@100&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
        <link rel="stylesheet" href="assets/css/style.css">
    </head>
    <body>
    <?php require 'partials/header.php'?>

  <!-- Contenido -->
        <div>
        <h1>Bienvenido</h1>
          <h4>Ingresa tu usuario</h4>

            <form action="login.php" method="POST">
            <input name="correo" type="text" placeholder="Ingrese su correo">
            <input name="password" type="password" placeholder="Ingrese su contraseña">
            <input type="submit" value="Acceder">
        
            <?php if(!empty($message)): ?>
              <p> <?= $message ?></p>
            <?php endif; ?>

            </form>
        </div>
    </body>
</html>